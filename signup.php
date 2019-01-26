<?php $name = "signup"?>
<?php require_once("includes/core.inc.php");?>
<?php
	if(isset($_SESSION['mkulima_id']) && !empty($_SESSION['mkulima_id'])){
			redirect_to("dashboard.php");
	}
?>
<?php
	if(isset($_POST['modal_submit'])){
		$required_fields = array("loginUsername","loginPassword");
		$errors = array();
		foreach($required_fields as $field){
			if(!isset($_POST[$field]) or empty($_POST[$field])){
				$errors[] = $field;
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

			if($r = $user->login($loginUsername, $loginPassword)){
				if($r['userType'] == 'STANDARD'){
					redirectTo('dashboard.php');
				}

				elseif($r['userType'] == 'ADMIN'){
					redirectTo('admin.php');
				}
			}

			else{
				$warning = '<script>$(document).ready(function(){swal("Ooops!", "' . $user->error() . '!", "error")});</script>';
			}
		}
		else{
			$warning = '<script>$(document).ready(function(){swal("Ooops!", "Please fill in the following field(s) before proceeding ' . implode(" , ", $errors) . '!", "error")});</script>';
		}
	}
?>
<?php
	if(isset($_POST['sign_up'])){
		$required_fields = array("fname" => "First name","lname" => "Last name", "gender"=>"Gender", "email" => "email", "username" => "username", "password" => "password", "cpassword" => "Confirm password");
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
			if($password === $cpassword){

				if($user->isUsernameAvailable($username)){
					if($user->isEmailAvailable($email)){
						if($user->addStandardUser($fname, $lname, $gender, $email, $username, $password)){
							if($userType = $user->login($username,$password)){
								if($userType = 'STANDARD'){
									redirectTo('dashboard.php');
								}

								elseif($userType = 'ADMIN'){
									redirectTo('admin.php');
								}
							}

							else{
								$msg = '<span class = "text-danger">' . $user->error() . '</span>';
							}
						}

						else{
							$msg = '<span class = "text-danger">' . $user->error() . '</span>';
						}
					}

					else{
						$msg = '<span class = "text-danger">' . $user->error() . '</span>';
					}

				}

				else{
					$msg = '<span class = "text-danger">' . $user->error() . '</span>';
				}
			}

			else{
				$msg =  '<span class = "text-danger">passwords don\'t match, please try again</span>';
			}
		}
		else{
			$msg =  '<span class = "text-danger">please fill in the field(s) ' . implode(' , ', $errors) . ' </span>';
		}
	}
?>
<?php require_once("includes/header.php");?>
<div class = "container-fluid hidden-xs">
	<div class = "row">
		<img src = "images/signup.jpg" class = "background img-responsive">
	</div>
</div>
<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.3);">
	<div class = "container" >
		<div class = "row px20top">
			<div class = "col-lg-7 col-md-7 col-sm-12 col-xs-12">
				<div class = "big_text" style = "text-align:left;">
					<h1>Sign up to get the most out of mkulima poa.</h1>
					<h2>With a mkulima poa account:</h2>
					<h4>- You can chat with other registered members.</h4>
					<h4>- You can post your products and advertise them.</h4>
					<h4>- You can post questions and advices.</h4>
					<h4>- And much much more :-D</h4>
					<h4 style = "" ><br /><br />Already have an account? <a href = "#" class = "link" data-toggle = "modal" data-target = "#login_modal">Sign in <i class = "fa fa-sign-in"></i></a><br /><br /></h4>
				</div>
			</div>
			<div class = "col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-body">
						<div class = "page-header" style = "color:rgba(71,97,124,1.0);">
							<h3>Sign up now!</h3>
							<p id = "message"><?php if(isset($msg) && !empty($msg)){echo $msg;}?> &nbsp;</p>
							<form action = "" method = "post" name = "form_register" id = "form_register">
								<div class = "row">
									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "fname">First name</label>
											<input type = "text" class = "form-control" value = "<?php if(isset($fname)){echo $fname;}?>" id = "fname" name = "fname" aria-required = "required" required  placeholder = "first name" />
										</div>
									</div>

									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "lname">Last name</label>
											<input type = "text" class = "form-control" value = "<?php if(isset($lname)){echo $lname;}?>" id = "lname" name = "lname" aria-required = "required" required placeholder = "last name" />
										</div>
									</div>


									<div class = "col-lg-12">
										<div class = "form-group">
											<label for = "gender">Gender</label><br />
											<input type = "radio" value = "M" checked = "checked" id = "male" name = "gender" /> Male
											<input type = "radio" value = "F" id = "female" name = "gender" /> Female
										</div>
										<div class = "form-group email_status">
											<label for = "email_reg" class="control-label">Email <span class = "email_error"></span></label>
											<input type = "email" class = "form-control" value = "<?php if(isset($email)){echo $email;}?>" id = "email_reg" name = "email" aria-required = "required" required placeholder = "email" />
										</div>
										<div class = "form-group username_status">
											<label for = "username_reg" class="control-label">Username <span class = "username_error"></span></label>
											<input type = "text" class = "form-control" value = "<?php if(isset($username)){echo $username;}?>" id = "username_reg" name = "username" aria-required = "required" required placeholder = "username" />
										</div>
									</div>


									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "password">Password</label>
											<input type = "password" class = "form-control" id = "password" name = "password" aria-required = "required" required placeholder = "password" />
										</div>
									</div>

									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "cpassword">Confirm Password</label>
											<input type = "password" class = "form-control" id = "cpassword" name = "cpassword" aria-required = "required" required placeholder = "confirm password" />
										</div>
									</div>
								</div>

								<a href = "index.php" class = "btn btn-info"><i class = "fa fa-arrow-circle-left"></i> Back</a>
								<button type = "submit" name = "sign_up" id = "sign_up" class = "btn btn-success" style = "float:right">Sign up <i class = "fa fa-user"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "modal fade" id = "login_modal">
		<div class = "modal-dialog">
			<div class = "modal-content">
				<div class = "modal-header">
					<button class = "close" style = "float:right;" type = "button" data-dismiss = "modal">&times;</button>
					<h3>Login to continue</h3>
				</div>
				<form action = "" method = "post">
					<div class = "modal-body">
						<div class = "form-group">
							<label for = "modal_username">Username or email</label>
							<input type = "text" class = "form-control" required aria-required = "required"  value = "<?php if(isset($loginUsername)){echo $loginUsername;}?>" placeholder = "username or email" name = "loginUsername" id = "modal_username" />
						</div>
						<div class = "form-group">
							<label for = "modal_password">Password</label>
							<input type = "password" class = "form-control" required aria-required = "required" placeholder = "password" name = "loginPassword" id = "modal_password" />
						</div>
					</div>
					<div class = "modal-footer">
						<button class = "btn btn-danger" type = "button" style = "float:left;" data-dismiss = "modal"><i class = "fa fa-close"></i> Close</button>
						<button class = "btn btn-info" type = "submit" style = "float:right;" name = "modal_submit">Log in <i class = "fa fa-sign-in"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/plain-footer.php");?>
