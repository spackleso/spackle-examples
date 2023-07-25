require 'spackle'
require 'sinatra'
require "sinatra/json"

Spackle.log_level = 'debug'

get '/' do
  send_file 'templates/index.html'
end

post '/customers' do
  Spackle.api_key = params[:api_key]
  start = Time.now
  customer = Spackle::Customer.retrieve(params[:customer_id])
  finish = Time.now
  json customer: customer.data, time: finish - start
end