<?php
	session_start();
	session_name("mkulimapoa.co.ke");
	
	date_default_timezone_set("Africa/Nairobi");
	
	require_once("../../includes/functions.php");
	require_once("../../includes/classes/DB.php");
	require_once("../../includes/classes/User.php");
	require_once("../../includes/classes/Message.php");
	
	
	$user = new User;
	$message = new Message;
	
	if(isset($_POST['method']) && $_POST['method'] == 'UPDATE_USER'){
		if($user->updateOnlineTime()){
			echo 'Updated';
		}else{
			echo $user->error();
		}
	}
	
	elseif(isset($_POST['method']) && $_POST['method'] == 'GET_USERS'){
		$data = array('active' => array());
	
		if($data = $user->getOnlineUsers()){
			echo json_encode($data);
		}else{
			echo json_encode($data);
		}
	}

	elseif(isset($_POST['method']) && $_POST['method'] == 'SEND'){
		if(isset($_POST['recepient']) && !empty($_POST['recepient'])){
			if(isset($_POST['text']) && !empty($_POST['text'])){
				
				$recepient = $_POST['recepient'];
				$text = $_POST['text'];
				
				if($message->newMessage(myId(), $recepient, $text)){
					echo 'Message sent :)';
				}
				
				else{
					echo $message->error();
				}
			}
		}
	}
	
	elseif(isset($_POST['method']) && $_POST['method'] == 'GET_USER_MESSAGES'){
		if(isset($_POST['recepient']) && !empty($_POST['recepient'])){
			$recepient = $_POST['recepient'];
			$me = myId();
			
			
			if($messages = $message->getChatboxMessages(myId())){
				$data = '';
				
				foreach($messages as $m){
					if($m['sender'] == $recepient && $m['recepient'] == $me ){
						$data .= '
								<div class = "notMine">
									<p>' . $m['text'] . '</p>
									<h5>' . date('g:i A',strtotime($m['date'])) . '</h5>
								</div>';
					}
					elseif($m['sender'] == $me && $m['recepient'] == $recepient){
						$data .= '
								<div class = "mine">
									<p>' . $m['text'] . '</p>
									<h5>' . date('g:i A',strtotime($m['date'])) . '</h5>
								</div>';
					}
				}
				
				echo $data;
			}
			
			else{
				echo $message->error();
			}
		}
	}
	
?>