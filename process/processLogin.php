<?php
	
	session_start();
	session_name("mkulimapoa.co.ke");
	date_default_timezone_set("Africa/Nairobi");
	require_once("../includes/functions.php");
	require_once("../includes/classes/DB.php");
	require_once("../includes/classes/User.php");
	
	$user = new User;
	
	$required_fields = array("username","password");
	$errors = array();
	
	foreach($required_fields as $field){
		if(!isset($_POST[$field]) or empty($_POST[$field])){
			$errors[] = $field;
		}
	}
	
	if(empty($errors)){
		$username = htmlentities(trim($_POST['username']));
		$password = htmlentities(trim($_POST['password']));
		
		if($details = $user->login($username, $password)){
			if($details['userType'] == 'STANDARD'){
				$u_img = empty($details['imgUrl']) || !file_exists("../images/uploads/". $details['imgUrl']) ? "images/default.png" : "images/uploads/" . $details['imgUrl'];
				$data = array("item" => array(
											  "status_id" => 1,
											  "name" => $details['fname'] . " " . $details['lname'],
											  "img_url" => $u_img
										)
							 );
				echo json_encode($data);
			}
			elseif($details['userType'] == 'ADMIN'){
				$u_img = empty($details['imgUrl']) || !file_exists("../images/uploads/". $details['imgUrl']) ? "images/default.png" : "images/uploads/" . $details['imgUrl'];
				$data = array("item" => array(
											  "status_id" => 2,
											  "name" => $details['fname'] . " " . $details['lname'],
											  "img_url" => $u_img
										)
							 );
				echo json_encode($data);
			}
		}
		
		else{
			$data = array("item" => array("status_id"=>0));
			echo json_encode($data);
		}
	}
	
	else{
		$data = array("item" => array("status_id"=>4));
		echo json_encode($data);
	}
?>