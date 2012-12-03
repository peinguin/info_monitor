function Change(){

	var intervals = {
		video: 3000,
		news:  5000,
		ads:   7000
	};

	var timers = {
		video: {
			id: undefined,
			auto: false
		},
		news: {
			id: undefined,
			auto: true
		},
		ads: {
			id: undefined,
			auto: true
		}
	};

	var get_next_url = function(type, fn){
		$.get(base+'/index.php?next='+type,function(data){fn(data)});
	}

	this.do_timer = function(type){
		clearInterval(timers[type].id);
		get_next_url(
			type,
			function(data){
				processors[type](data);
				timers[type].id = setInterval(function(){change.do_timer(type)},intervals[type]);
			}
		);
	}

	var processors = {
		news: function(data){
			$.get(data,function(data){
				$('#news').html(data);
			});
		},
		ads: function(data){
			$.get(data,function(data){
				$('#ads').html(data);
			});
		},
		video: function(data){
			if(big_player){
				big_player.pause();
				big_player.setSrc(data);
				big_player.load();
				big_player.play();
			}
		}
	}

	for(var timer in timers){
		if(timers[timer].auto)
			this.do_timer(timer);
	}
}

var big_player = undefined;
var change = undefined;
$(document).ready(function(){
	change = new Change();
	$('#player').mediaelementplayer({
	    success: function(media, node, player) {
	    	big_player = media;
	    	change.do_timer('video');
	    }
	});
});