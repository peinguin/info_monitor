#!/usr/bin/ruby
require 'Qt4'
require 'qtwebkit'

Qt::Application.new(ARGV) do
Qt::WebView.new do
self.load Qt::Url.new('http://www.wolframalpha.com/')
show
end
exec
end