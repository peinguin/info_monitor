<?php

function base(){
	$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http";
	$uri = preg_match('/^(.*)\/[^\/]*$/', $_SERVER['REQUEST_URI'], $matches);
	if($uri){
		$uri = $matches[1];
	}else{
		$uri = '/';
	}
	return $protocol . "://" . $_SERVER['HTTP_HOST'] . $uri;
}