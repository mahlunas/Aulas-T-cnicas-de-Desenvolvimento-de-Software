# Dockerfile

# Usar uma imagem base do Python
FROM python:3.9-slim

# Instalar dependências
COPY requirements.txt requirements.txt
RUN pip install -r requirements.txt

# Copiar os arquivos do projeto
COPY app.py /app.py

# Expor a porta
EXPOSE 5000

# Comando para iniciar o serviço
CMD ["python", "app.py"]
