# app.py

# Importar as bibliotecas necessárias
from flask import Flask, request, jsonify  # Para criar a aplicação web e manipular requisições HTTP
from PIL import Image  # Para trabalhar com imagens
import io  # Para trabalhar com operações de entrada e saída de bytes
import torch  # PyTorch, uma biblioteca popular para aprendizado de máquina
from torchvision import models, transforms  # Contém modelos de visão computacional e transformações de imagem
import requests  # Para fazer requisições HTTP

# Carregar o modelo pré-treinado
model = models.resnet50(pretrained=True)  # Carrega o modelo ResNet-50 pré-treinado
model.eval()  # Coloca o modelo em modo de avaliação, desabilitando a computação do gradiente

# Preprocessamento da imagem
preprocess = transforms.Compose([  # Cria uma sequência de transformações a serem aplicadas na imagem
    transforms.Resize(256),  # Redimensiona a imagem para 256x256 pixels
    transforms.CenterCrop(224),  # Corta o centro da imagem com dimensões 224x224 pixels
    transforms.ToTensor(),  # Converte a imagem PIL para um tensor
    transforms.Normalize(mean=[0.485, 0.456, 0.406], std=[0.229, 0.224, 0.225]),  # Normaliza os valores dos pixels
])

# Carregar as classes do ImageNet
LABELS_URL = "https://raw.githubusercontent.com/anishathalye/imagenet-simple-labels/master/imagenet-simple-labels.json"
labels = requests.get(LABELS_URL).json()  # Faz uma requisição HTTP para obter as classes do ImageNet

app = Flask(__name__)  # Cria uma instância da aplicação Flask

@app.route('/predict', methods=['POST'])  # Define uma rota '/predict' para aceitar requisições POST
def predict():
    if 'file' not in request.files:  # Verifica se o arquivo de imagem foi enviado na requisição
        return jsonify({'error': 'No file provided'}), 400  # Retorna um erro se nenhum arquivo foi fornecido

    file = request.files['file']  # Obtém o arquivo de imagem da requisição
    img_bytes = file.read()  # Lê os bytes do arquivo
    img = Image.open(io.BytesIO(img_bytes)).convert('RGB')  # Abre a imagem e converte para o modo RGB
    
    # Preprocessar a imagem
    img_t = preprocess(img)  # Aplica as transformações de pré-processamento na imagem
    batch_t = torch.unsqueeze(img_t, 0)  # Adiciona uma dimensão extra para criar um lote de tamanho 1
    
    # Realizar a predição
    with torch.no_grad():  # Desabilita o cálculo de gradientes para economizar memória
        out = model(batch_t)  # Realiza a predição utilizando o modelo

    # Obter a classe de maior probabilidade
    _, indices = torch.max(out, 1)  # Obtém o índice da classe com maior probabilidade
    label = labels[indices[0]]  # Obtém o rótulo correspondente ao índice da classe
    
    return jsonify({'label': label})  # Retorna o rótulo previsto em formato JSON

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)  # Executa a aplicação Flask na porta 5000
