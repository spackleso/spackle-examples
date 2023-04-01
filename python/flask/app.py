import os
import time

import spackle
from flask import Flask, render_template, request, jsonify

spackle.api_key = os.getenv('SPACKLE_API_KEY')
spackle.log = "debug"
spackle.bootstrap()


app = Flask(__name__)


@app.route("/")
def home():
    return render_template('index.html')


@app.route("/customers", methods=['POST'])
def customer():
    start = time.time()
    customer = spackle.Customer.retrieve(request.form.get('customer_id'))
    end = time.time()
    return jsonify({
        'time': end - start,
        'customer': customer.data,
    })
