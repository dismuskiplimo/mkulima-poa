<?php
	//error_reporting(0);
	session_start();
	session_name("mkulimapoa.co.ke");
	
	date_default_timezone_set("Africa/Nairobi");
	require_once("functions.php");
	
	$classes = ['DB','User', 'Message', 'Product', 'Post'];
	
	foreach($classes as $class){
		if(file_exists('includes/classes/'. $class . '.php')){
			spl_autoload_register(function ($class) {
				require 'classes/'. $class . '.php';
			});
		}
	}
	
	$msg = '';
	
	$user = new User;
	$message = new Message;
	$product = new Product;
	$post = new Post;
	
?>