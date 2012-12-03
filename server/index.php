<?php

session_start();

include('php-functions/core.php');

if(isset($_REQUEST['next'])){

	if($_REQUEST['next'] == 'news'){
		$_SESSION['current_news'] = ((isset($_SESSION['current_news'])?$_SESSION['current_news']:-1) + 1) % 2;
		$current = $_SESSION['current_news'];
		$prefix = 'new';
		$ext = 'html';
	}elseif($_REQUEST['next'] == 'ads'){
		$_SESSION['current_ads'] = ((isset($_SESSION['current_ads'])?$_SESSION['current_ads']:-1) + 1) % 2;
		$current = $_SESSION['current_ads'];
		$prefix = 'ad';
		$ext = 'html';
	}else{
		$_SESSION['current_video'] = ((isset($_SESSION['current_video'])?$_SESSION['current_video']:-1) + 1) % 2;
		$current = $_SESSION['current_video'];
		$prefix = 'video';
		$ext = 'mp4';
	}
	echo base().'/assets/'.$prefix.$current.'.'.$ext;
}else{
	include('index.html');
}