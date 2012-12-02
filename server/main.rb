#!/usr/bin/ruby1.8
require 'Qt4'
require 'qtwebkit'

Qt::Application.new(ARGV) do
	Qt::WebView.new do
		self.load Qt::Url.new(ARGV[0])
		show
	end
	exec
end