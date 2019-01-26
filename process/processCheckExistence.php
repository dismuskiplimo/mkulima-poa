<?php
	require_once("../includes/functions.php");
	require_once("../includes/classes/DB.php");
	require_once("../includes/classes/User.php");
	
	$user = new User;
	
	if(isset($_POST['username'])){
		$username = $_POST['username'];
		
		if(strlen($username) >= 4 && $username != NULL){
			if($user->isUsernameAvailable($username)){
				echo '0';
			}
			else{
				echo '1';
			}
		}
		else{
			echo '2';
		}
	}
	elseif(isset($_POST['email'])){
		$email = $_POST['email'];
		
		if(strlen($email) >= 4 && $email != NULL){
			if($user->validateEmail($email)){
				if($user->isEmailAvailable($email)){
					echo '0';
				}
				else{
					echo '1';
				}
			}
			else{
				echo '3';
			}
		}
		else{
			echo '2';
		}
	}
	
	else{
		echo '2';
	}
?>