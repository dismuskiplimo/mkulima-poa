<?php

	class Message extends DB{
		public function newMessage($sender, $recepient, $message){
			$query = 'INSERT INTO messages(sender,recepient,text) VALUES(?,?,?)';
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('sss',$sender, $recepient, $message);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				
				else{
					$this->_error = 'Sorry, we encountered an error while sending message, please try again';
				}
				
			}
			else{
				$this->_error = 'Sorry, we encountered an error while executing query, please try again';

			}
		}
		
		public function getMessages($id, $type = 'INBOX'){
					 
					 if($type == "INBOX"){
						 $query = "
									SELECT messages.id, messages.sender, messages.recepient, messages.text, messages.read_status, messages.created, users.fname, users.lname
									FROM messages 
									LEFT JOIN users
									ON messages.sender = users.id 
									WHERE messages.recepient = ? "; 
					 }
					 
					 elseif($type == "OUTBOX"){
						 $query = "
									SELECT messages.id, messages.sender, messages.recepient, messages.text, messages.read_status, messages.created, users.fname, users.lname
									FROM messages 
									LEFT JOIN users
									ON messages.recepient = users.id 
									WHERE messages.sender = ? "; 
					 }
					 
					 else{
						 $query = "
									SELECT messages.id, messages.sender, messages.recepient, messages.text, messages.read_status, messages.created, users.fname, users.lname
									FROM messages 
									LEFT JOIN users
									ON messages.sender = users.id ";
									
						 $query .= $type;
					 }
					 
					 $query .= "ORDER BY messages.created DESC";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$messages = array();
					
					$statement->bind_result($messageId, $sender_id, $recepient_id, $message, $read_status, $date_created, $fname, $lname);
					
					while($statement->fetch()){
						$messages[] = array(
							'messageId'=> $messageId,
							'senderId'=> $sender_id,
							'recepientId'=> $recepient_id,
							'message'=> $message,
							'readStatus'=> $read_status,
							'dateCreated'=> $date_created,
							'fname'=> $fname,
							'lname'=> $lname
						);						
					}
					
					return $messages;
				}
				
				else{
					$this->_error = 'Nothing here :(';
				}
			}
			
			else{
				$this->_error = 'Failed to execute';
			}
		}
		
		public function getChatboxMessages($id){
			$query = "SELECT  sender, recepient , text , created FROM messages WHERE sender = ? OR recepient = ?";
			$stat = $this->_conn->prepare($query);
			$stat->bind_param('ss',$id,$id);
			if($stat->execute()){
				$stat->store_result();
				if($stat->num_rows > 0){
					$stat->bind_result($sender,$recepient,$text,$created);
					$messages = array();
					
					while($stat->fetch()){
						$messages[] = array(
							'sender'=>$sender,
							'recepient'=>$recepient,
							'text'=>$text,
							'date'=>$created
						);
					}
					
					return $messages;
				}else{
					$this->_error = 'No messages';
				}
			}else{
				$this->_error = 'Query error';
			}
		}
		
		public function getMessage($id){
			$query = "SELECT messages.id, messages.sender, messages.recepient, messages.text, messages.read_status, messages.created, users.fname, users.lname
					  FROM messages 
					  LEFT JOIN users 
					  ON messages.sender = users.id 
					  WHERE id = ? 
					  LIMIT 1";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
			
					$statement->bind_result($messageId, $sender_id, $recepient_id, $message, $read_status, $date_created, $fname, $lname);
					
					while($statement->fetch()){
						$messages = array(
							'messageId'=> $messageId,
							'senderId'=> $sender_id,
							'recepientId'=> $recepient_id,
							'message'=> $message,
							'readStatus'=> $read_status,
							'dateCreated'=> $date_created,
							'fname'=> $fname,
							'lname'=> $lname
						);						
					}
					
					return $messages;
				}
				
				else{
					$this->_error = 'No messages found :(';
				}
			}
			
			else{
				$this->_error = 'Failed to execute';
			}
		}
		
		public function deleteMessage($id){
			$query = "DELETE FROM messages WHERE id = ?";
			
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			
			if($statement->execute()){
				$statement->store_result();
				
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Message not deleted, try again';
				}
			}
			else{
				$this->_error = 'Failed to execute';
			}
		}
	}

?>