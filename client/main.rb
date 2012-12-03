#!/usr/bin/ruby1.8
require 'Qt4'
require 'qtwebkit'

class WebPage < Qt::WebPage
	def initialize(wnd=nil)
		super
		@wnd = wnd
	end
    def javaScriptConsoleMessage(msg, lineNumber, sourceID)
    	super msg, lineNumber, sourceID
    	puts(sourceID, lineNumber, msg)
    	@wnd.reload
    end
end
class Window < Qt::Widget
	def initialize(url,parent=nil)
		super parent

		@url = url

		@view = Qt::WebView.new
    	@view.setPage(WebPage.new(self))

		reload

	    layout = Qt::VBoxLayout.new(self)
	    layout.setMargin(0)
	    layout.addWidget(@view)
	end

	def view
      @view
    end
    def view=(val)
      @view = val
    end

    def reload
    	@view.load Qt::Url.new(@url)
    end
end

app = Qt::Application.new(ARGV)
Window.new(ARGV[0]) do
	show
end
app.exec
