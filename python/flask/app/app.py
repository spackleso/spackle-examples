import os
import time

import spackle
from flask import Flask, render_template, request, jsonify

spackle.log = "debug"


app = Flask(__name__)


@app.route("/")
def home():
    return render_template('index.html')


@app.route("/customers", methods=['POST'])
def customer():
    spackle.api_key = request.form.get('api_key')
    start = time.time()
    customer = spackle.wait_for_customer(request.form.get('customer_id'))
    end = time.time()
    return jsonify({
        'time': end - start,
        'customer': customer.data,
    })
