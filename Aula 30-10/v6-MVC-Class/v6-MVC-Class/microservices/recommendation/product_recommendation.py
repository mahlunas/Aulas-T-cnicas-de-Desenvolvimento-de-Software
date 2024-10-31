from flask import Flask, request, jsonify
from gensim.models import Word2Vec
from sklearn.metrics.pairwise import cosine_similarity
import pandas as pd

app = Flask(__name__)

class ProductRecommendation:
    def __init__(self, data):
        self.sentences = [str(sentence).split() for sentence in data['name']]
        self.word2vec_model = Word2Vec(self.sentences, vector_size=100, window=5, min_count=1, workers=4)

    def train_word2vec_model(self):
        if not self.word2vec_model.wv.vectors.any():
            print("Word2Vec model is not trained or loaded properly.")

    def recommend_products(self, last_purchase, n=5):
        last_purchase_embedding = [self.word2vec_model.wv[word] for word in last_purchase.split() if word in self.word2vec_model.wv]

        if not last_purchase_embedding:
            return "No recommendation available for this purchase."

        last_purchase_embedding_avg = sum(last_purchase_embedding) / len(last_purchase_embedding)

        similarities = []
        for sentence in self.sentences:
            product_embedding = [self.word2vec_model.wv[word] for word in sentence if word in self.word2vec_model.wv]
            if product_embedding:
                product_embedding_avg = sum(product_embedding) / len(product_embedding)
                similarity = cosine_similarity([last_purchase_embedding_avg], [product_embedding_avg])[0][0]
                similarities.append((sentence, similarity))

        recommendations = sorted(similarities, key=lambda x: x[1], reverse=True)[:n]

        return [rec[0] for rec in recommendations]

data = pd.read_csv('electronics.csv')
product_recommendation = ProductRecommendation(data)
product_recommendation.train_word2vec_model()

@app.route('/recommend', methods=['POST'])
def recommend():
    data = request.get_json()
    last_purchase = data['last_purchase']
    if last_purchase:
        recommended_products = product_recommendation.recommend_products(last_purchase)
        return jsonify({"recommended_products": recommended_products})
    else:
        return jsonify({"error": "Parameter last_purchase was not informed."})

if __name__ == '__main__':
    app.run(debug=True)