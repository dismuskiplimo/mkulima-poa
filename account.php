<?php 
	
	$name = "account";
	require_once("includes/core.inc.php");
	require_once("includes/userSession.inc.php");
	
	$id = $sessionDetails['id'];

	if(isset($_POST['submit_account'])){
		$required_fields = array("fname" => "First name", "lname" => "Last name", "email" => "email");
		$errors = array();
		foreach($required_fields as $field => $detail){
			if(!isset($_POST[$field]) || empty($_POST[$field])){
				$errors[] = $detail;
			}
		}
		
		foreach($_POST as $key => $value){
			if(isset($value) && !empty($value)){
				${$key} = htmlentities(trim($value));
			}
			
			else{
				${$key} = $value; 
			}
		}
		
		if(empty($errors)){
			
			if($user->updateStandardUser($fname, $lname, $gender , $email, $DOB , $about, $interests, $hometown, $address, $id)){
				$msg =  '<span class = "text-success">Profile updated :)</span>';
			}
			
			else{
				$msg =  '<span class = "text-danger">' . $user->error() . '</span>';
			}
			
		}
		
		else{
			$msg =  '<span class = "text-danger">Please fill in the following field(s) before proceeding ' . implode(' , ', $errors). '</span>';
		}
	}

	if(isset($_POST['submit_profile_pic'])){
		if($user->updateProfilePic('profile_pic', $id)){
			$msg =  '<span class = "text-success">Profile picture updated</span>';
		}
		
		else{
			$msg =  '<span class = "text-danger">' . $user->error() . '</span>';
		}
			
	}

	if(isset($_POST['updatePassword'])){
		$required_fields = array("o_pass" => "Old password", "pass" => "Password", "c_pass" => "Confirm password");
		$errors = array();
		foreach($required_fields as $field => $detail){
			if(!isset($_POST[$field]) or empty($_POST[$field])){
				$errors[] = $detail;
			}
		}
		
		if(empty($errors)){
			foreach($_POST as $key => $value){
				if(isset($value) && !empty($value)){
					${$key} = htmlentities(trim($value));
				}
				
				else{
					${$key} = $value; 
				}
			}
			
			if($c_pass === $pass){
				if($user->updatePassword($o_pass, $pass, $id)){
					$msg =  '<span class = "text-success">Password changed successfully</span>';
				}
				
				else{
					$msg =  '<span class = "text-danger">' . $user->error() . '</span>';
				}
			}
			
			else{
				$msg =  '<span class = "text-danger">Sorry, password and confirm password do not match</span>';
			}
		}
		
		else{
			$msg =  '<span class = "text-danger">Please fill in the following field(s) before proceeding ' .implode(' , ', $errors) . '</span>';
		}
	}

	
	if(!$details = $user->getUserDetails($sessionDetails['id'])){
		redirectTo('logout.php');
	
	}
	
	$sessionDetails = $_SESSION['mkulimaUserDetails'];
	
	
?>
<?php require_once("includes/header.php");?>
<?php require_once("includes/user_menu.php");?>
<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container" >
		<div class = "row px20top">
			<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
			</div>
			<div class = "col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-body">
						<div class = "" style = "color:rgba(71,97,124,1.0);">
							<div class = "hundred">
								<h3>PROFILE PICTURE <i class = "fa fa-camera"></i></h3>
								<p><?php if(isset($msg) && !empty($msg)){echo $msg;}?> &nbsp;</p>
								<form class = "margin_tp" action = "" method = "post" enctype = "multipart/form-data">
									<div class = "row">
										<div class = "col-lg-3 col-md-4 col-sm-6" style = "overflow:hidden">
											<img style = "height:200px; width:auto;" src = "<?php echo load_profile_image($details['imgUrl']); ?>" alt = "<?php echo $details['fname'] ." ". $details['lname'];?>" />
										</div>
										<div class = "col-lg-9 col-md-8 col-sm-6">
											<label for = "profile_pic">Profile picture (Square image recomended)</label>
											<input type = "file" required name = "profile_pic" id = "profile_pic" /><br />
											<button class = "btn btn-info" name = "submit_profile_pic" type = "submit">Update profile picture</button>
										</div>
									</div>
								</form>
							</div>
							
							<div class = "hundred">
								<h3>PROFILE INFO <i class = "fa fa-user"></i></h3>
								<p>&nbsp;</p>
								<form class = "margin_tp" action = "" method = "post">
									<div class = "row">
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "f_name">First name</label>
												<input type = "text" required name = "fname" value = "<?php echo $details['fname'];?>" id = "f_name" placeholder = "first name" class = "form-control" />
											</div>
										</div>
										
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "l_name">Last name</label>
												<input type = "text" required name = "lname" value = "<?php echo $details['lname'];?>" id = "l_name" placeholder = "last name" class = "form-control" />
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "gender">Gender</label><br />
												
												<label class="radio-inline">
													<input type = "radio" name = "gender" value = "M" <?php if($details['gender'] == 'M'){echo 'checked = "checked"' ;}?> /> MALE
												</label>
												<label class="radio-inline">
													<input type = "radio" name = "gender" value = "F" <?php if($details['gender'] == 'F'){echo 'checked = "checked"' ;}?> /> FEMALE
												</label>
											</div>
										</div>
										
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "DOB">DOB</label>
												<input type = "text" required name = "DOB" value = "<?php echo $details['DOB'];?>" id = "DOB" placeholder = "date of birth" class = "form-control" />
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "username">Username</label>
												<input type = "text" name = "username" disabled value = "<?php echo $details['username'];?>" id = "username" class = "form-control" />
											</div>
										</div>
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "email">Email</label>
												<input type = "text" required name = "email" value = "<?php echo $details['email'];?>" id = "email" placeholder = "email" class = "form-control" />
											</div>
										</div>
									</div>
									
									<div class = "form-group">
										<label for = "about">About me</label>
										<textarea rows = "4" name = "about" id = "about" placeholder = "about" class = "form-control"><?php echo $details['about'];?></textarea>
									</div>
									<div class = "form-group">
										<label for = "interests">Interests</label>
										<textarea rows = "4" name = "interests" id = "interests" placeholder = "interests" class = "form-control"><?php echo $details['interests'];?></textarea>
									</div>
									<div class = "form-group">
										<label for = "hometown">Hometown</label>
										<input type = "text" name = "hometown" value = "<?php echo $details['hometown'];?>" id = "hometown" placeholder = "hometown" class = "form-control" />
									</div>
									<div class = "form-group">
										<label for = "address">Address</label>
										<input type = "text" name = "address" value = "<?php echo $details['address'];?>" id = "address" placeholder = "address" class = "form-control" />
									</div>
									<button class = "fl_r btn btn-info" name = "submit_account" type = "submit">Update profile</button>
								</form>
							</div>
							<div class = "hundred">
								<h3>CHANGE PASSWORD <i class = "fa fa-key"></i></h3>
								<form class = "margin_tp" action = "" method = "post">
									<div class = "form-group">
										<label for = "o_pass">Old password</label>
										<input type = "password" required name = "o_pass" id = "o_pass" placeholder = "old password" class = "form-control" />
									</div>
									<div class = "row">
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "pass">New password</label>
												<input type = "password" required name = "pass" id = "pass" placeholder = "new password" class = "form-control" />
											</div>
										</div>
										<div class = "col-lg-6">
											<div class = "form-group">
												<label for = "c_pass">Confirm password</label>
												<input type = "password" required name = "c_pass" id = "c_pass" placeholder = "confirm password" class = "form-control" />
											</div>
										</div>
									</div>
									
									<button class = "fl_r btn btn-info" type = "submit" name = "updatePassword">Change password</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>