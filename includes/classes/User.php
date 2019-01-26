<?php

	class User extends DB{
		public function addStandardUser($fname, $lname, $gender, $email, $username, $password){
			$query = "INSERT INTO users(fname,lname,gender,email,username,password) VALUES(?, ?, ?, ?, ?, ?)";
			$hpassword = sha1($password);
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("ssssss", $fname, $lname, $gender, $email, $username, $hpassword);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = "Oops something went wrong";
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function getAllUserDetails($sessionId = ''){
			if(!empty($sessionId)){
				$tag = "AND id != '" . $sessionId . "'";
			}
			else{
				$tag = '';
			}
			
			$query = "SELECT id, fname, lname, username, email, gender, DOB, about, interests, hometown, address, user_type, img_url, thumb_url, date_registered, lastActiveTime   
			          FROM users WHERE user_type = 'STANDARD' $tag";
			$statement = $this->_conn->prepare($query);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($id, $fname, $lname, $username, $email, $gender, $DOB, $about, $interests, $hometown, $address, $userType, $imgUrl, $thumbUrl, $dateRegistered, $lastActiveTime);
					$details = array();
					
					while($statement->fetch()){
						$details[] = array(
							'id' => $id,
							'fname' => $fname,
							'lname' => $lname,
							'username' => $username,
							'email' => $email,
							'gender' => $gender,
							'DOB' => $DOB,
							'about' => $about,
							'interests' => $interests,
							'hometown' => $hometown,
							'address' => $address,
							'userType' => $userType,
							'imgUrl' => $imgUrl,
							'thumbUrl' => $thumbUrl,
							'dateRegistered' => $dateRegistered,
							'lastActiveTime' => $lastActiveTime
						);
					}
					
					return $details;
				}
				
				else{
					//user not found
					$this->_error = 'User not found';
				}
			}
			else{
				$this->_error = mysqli_error($db);
			}	
		}
		
		public function getUserDetails($id, $type = 'id'){
			
			if($type == 'id'){
				$field = 'id';
			}elseif($type == 'username'){
				$field = 'username';
			}else{
				exit;
			}
			$query = "SELECT id,fname, lname, username, email, gender, DOB, about, interests, hometown, address, user_type, img_url, thumb_url, date_registered, lastActiveTime   
			          FROM users WHERE $field = ? 
					  LIMIT 1";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s",$id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows < 1){
					//user not found
					$this->_error = 'User not found';
				}
				
				if($statement->num_rows == 1){
					$statement->bind_result($id,$fname, $lname, $username, $email, $gender, $DOB, $about, $interests, $hometown, $address, $userType, $img_url, $thumb_url, $date_registered, $lastActiveTime);
					$details = array();
					
					while($statement->fetch()){
						$details['id'] = $id;
						$details['fname'] = strtoupper($fname);
						$details['lname'] = strtoupper($lname);
						$details['fullName'] = strtoupper($fname . '  '. $lname);
						$details['username'] = $username;
						$details['email'] = $email;
						$details['gender'] = $gender;
						$details['DOB'] = $DOB;
						$details['about'] = $about;
						$details['interests'] = $interests;
						$details['hometown'] = $hometown;
						$details['address'] = $address;
						$details['userType'] = $userType;
						$details['imgUrl'] = $img_url;
						$details['thumbUrl'] = $thumb_url;
						$details['dateRegistered'] = $date_registered;
						$details['lastActiveTime'] = $lastActiveTime;
					}
					
					return $details;
				}
			}
			else{
				$this->_error = mysqli_error($db);
			}	
		}
		
		public function updateStandardUser($fname, $lname, $gender, $email, $DOB, $about, $interests, $hometown, $address, $id){
			$query = "UPDATE users SET fname = ?, lname = ?, gender = ?, email = ?, DOB = ?, about = ?, interests = ?, hometown = ?, address = ?
					  WHERE id = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("ssssssssss", $fname, $lname, $gender, $email, $DOB, $about, $interests, $hometown, $address, $id);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					$details = $this->getUserDetails($id);
					
					if($details['userType'] == 'STANDARD'){
						$_SESSION['mkulimaUserDetails'] = $details;
					}
					
					elseif($details['userType'] == 'ADMIN'){
						$_SESSION['mkulimaAdminDetails'] = $details;
					}
					
					return 1;
				}
				else{
					$this->_error = "The same details were input, no changes made";
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function updateProfilePic($pic, $id){
			if(isset($_FILES[$pic]['name'])){
				if(!$img_url = upload_picture($pic)){
					$img_url = '';
				}
			}
			else{
				$img_url = '';
			}
			
			if(!empty($img_url)){
				$initial_image_path = "images/uploads/" . $img_url;
				$final_image_path = "images/uploads/main_" . $img_url;
				$final_image = "main_" . $img_url;
				$final_thumb_path = "images/uploads/thumb_" . $img_url;
				$final_thumb = "thumb_" . $img_url;
				
				
				create_square_image($final_image_path,$initial_image_path,400);
				create_square_image($final_thumb_path,$initial_image_path,80);
				$thumb_url = $final_thumb;
				$img_url = $final_image;
				
				//delete uploaded image
				unlink($initial_image_path);
			}
			
			$query = "UPDATE users SET img_url = ?, thumb_url = ? WHERE id = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("sss",$img_url,$thumb_url,$id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows < 1){
					$this->_error =  "Sorry, you did not make any changes, profile picture not updated";
				}
				if($statement->affected_rows == 1){
					$details = $this->getUserDetails($id);
					
					if($details['userType'] == 'STANDARD'){
						$_SESSION['mkulimaUserDetails'] = $details;
					}
					elseif($details['userType'] == 'ADMIN'){
						$_SESSION['mkulimaAdminDetails'] = $details;
					}
					return 1;
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function updatePassword($oldPassword, $newPassword, $id){
			
			$oldPassword = sha1($oldPassword);
			$query = "SELECT password 
					  FROM users 
					  WHERE id = ? 
					  LIMIT 1";
			
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s", $id);	
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows == 1){
					$statement->bind_result($oldPass);
					while($statement->fetch()){
						$oldPass = $oldPass;
					}
					
					if($oldPassword === $oldPass){
						$newPassword = sha1($newPassword);
						$query = "UPDATE users SET password = ? 
								  WHERE id = ?";
						$statement = $this->_conn->prepare($query);
						$statement->bind_param("ss", $newPassword, $id);
						
						if($statement->execute()){
							$statement->store_result();
							if($statement->affected_rows > 0){
								return 1;
							}
							else{
								$this->_error = "The same password was used, no changes made";
							}
						}
						else{
							$this->_error = mysqli_error($this->_conn);
						}
					}
					
					else{
						$this->_error = "The password provided does not match the one in our database";
					}
				}
				
				else{
					$this->_error = "The user does not exist";
				}
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
					  
		}
		
		public function isUsernameAvailable($username){
			$query = "SELECT username FROM users WHERE username = ? LIMIT 1";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s",$username);
			
			if($statement->execute()){
				$statement->store_result();
				
				if($statement->num_rows == 0){
					return 1;
				}
				
				else{
					$this->_error = 'Username <strong>'.$username.'</strong> is already taken';
				}
			}
			
			else{
				$this->_error = 'Sorry, there is an error with the query';
			}
					
		}
		
		public function isEmailAvailable($email){
			$query = "SELECT email FROM users WHERE email = ? LIMIT 1";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s",$email);
			
			if($statement->execute()){
				$statement->store_result();
				
				if($statement->num_rows == 0){
					return 1;
				}
				
				else{
					$this->_error = 'Email <strong>' . $email . '</strong> is already taken';
				}
			}
			
			else{
				$this->_error = 'Sorry, there is an error with the query';
			}
					
		}
		
		public function login($username,$password){
			$query = "SELECT id,fname,lname,img_url, thumb_url,username,user_type 
			          FROM users 
					  WHERE (username = ?) 
					  AND (password = ?) 
					  LIMIT 1";
			$statement = $this->_conn->prepare($query);
			$hpass = sha1($password);
			
			$statement->bind_param("ss",$username, $hpass);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows != 1){
					//user not found
					$this->_error =  "invalid username and or password";
				}
				
				else{
					
					$statement->bind_result($id, $fname,$lname ,$img_url, $thumb_url, $username, $user_type);
					$details = array(); 
					
					while($statement->fetch()){
						$details['id'] = $id;
						$details['fname'] = strtoupper($fname);
						$details['lname'] = strtoupper($lname);
						$details['fullName'] = strtoupper($fname . '  '. $lname);
						$details['imgUrl'] = $img_url;
						$details['thumbUrl'] = $thumb_url;
						$details['username'] = $username;
						$details['userType'] = $user_type;
						$details['ipAddress'] = $_SERVER['REMOTE_ADDR'];
					}
					
					if($details['userType'] == 'STANDARD'){
						
						$_SESSION['mkulimaUserDetails'] = $details;
					
					}
					
					elseif($details['userType'] == 'ADMIN'){
						$_SESSION['mkulimaAdminDetails'] = $details;
						
					}
					
					return $details;
				}
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function removeUser($id){
			$query = "DELETE FROM users WHERE id = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'User does not exist';
				}
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
			
		}
		
		public function getOnlineUsers(){
			$query = "SELECT id,fname,lname,thumb_url FROM users WHERE (lastActiveTime > NOW() - 60) AND  (id != '" . myId() . "')";
			$stat = $this->_conn->prepare($query);
			if($stat->execute()){
				$stat->store_result();
				
				$data = array('active' => array());
				if($stat->num_rows > 0){
					$stat->bind_result($id,$fname,$lname,$thumb_url);
					while($stat->fetch()){
						$data['active'][] = ['id' => $id, 'fname' => $fname,'lname' => $lname, 'thumb_url' => $thumb_url];
					}
		
					return $data;
				}
				else{
					$this->_error = 'No users found';
				}
			}
			else{
				$this->_error = 'Error in query';
			}
		}
		
		public function updateOnlineTime(){
			$query = "UPDATE users SET lastActiveTime = NOW() WHERE id = ?";
			$stat = $this->_conn->prepare($query);
			$stat->bind_param('s', myId());
			if($stat->execute()){
				$stat->store_result();
				if($stat->affected_rows >0){
					return 1;
				}
				else{
					$this->_error = 'User time not updated';
				}
			}
			else{
				$this->_error = 'Error in query';
			}
		}
		
		public function getCount($description){
			if($description == 'registered'){
				$query = "SELECT * FROM users WHERE user_type = 'STANDARD'";
			}
			
			elseif($description == 'onlineNow'){
				$query = "SELECT * FROM users WHERE lastActiveTime > NOW() - 60 AND  id != '" . myId() . "'";
			}
			
			else{
				$this->_error = 'Invalid argument';
				exit;
			}
			
			$statement = $this->_conn->prepare($query);
			
			if($statement->execute()){
				$statement->store_result();
				return $statement->num_rows;
			}
			else{
				$this->_error = 'Error in query';
			}
		}
		
		public function getUserCount($who = 'onlineToday'){
			
			$query = 'SELECT date_registered,lastActiveTime FROM users';
			$statement = $this->_conn->prepare($query);
			$count = 0;
			
			if($statement->execute()){
				$statement->store_result();
				$statement->bind_result($date_registered, $lastActiveTime);
				while($statement->fetch()){
					if($who == 'onlineToday'){
						if(check_date($lastActiveTime) == 'Today'){
							$count++;
						}
					}
				
					if($who == 'registeredToday'){
						if(check_date($date_registered) == 'Today'){
							$count++;
						}
					}
					
					if($who == 'onlineYesterday'){
						if(check_date($lastActiveTime) == 'Yesterday'){
							$count++;
						}
					}
				
					if($who == 'registeredYesterday'){
						if(check_date($date_registered) == 'Yesterday'){
							$count++;
						}
					}
				}
				
				return $count;
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
			
		}
	}

?>