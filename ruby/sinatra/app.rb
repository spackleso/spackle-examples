require 'dotenv/load'
require 'spackle'
require 'sinatra'
require "sinatra/json"

Spackle.api_key = ENV['SPACKLE_API_KEY']
Spackle.log_level = 'debug'
Spackle.bootstrap()

get '/' do
  send_file 'templates/index.html'
end

post '/customers' do
  start = Time.now
  customer = Spackle::Customer.retrieve(params[:customer_id])
  finish = Time.now
  puts "Time to create customer: #{finish - start}"
  json customer: customer.data, time: finish - start
end