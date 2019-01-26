
<?php $name = "login"?>
<?php require_once("includes/core.inc.php");?>
<?php
	if(isset($_SESSION['mkulimaUserDetails']) && !empty($_SESSION['mkulimaUserDetails'])){
			redirect_to("dashboard.php");
	}

	if(isset($_SESSION['mkulimaAdminDetails']) && !empty($_SESSION['mkulimaAdminDetails'])){
			redirect_to("admin.php");
	}

?>
<?php
	if(isset($_POST['submit'])){
		$required_fields = array("username","password");
		$errors = array();
		foreach($required_fields as $field){
			if(!isset($_POST[$field]) or empty($_POST[$field])){
				$errors[] = $field;
			}
		}

		if(empty($errors)){
			foreach($_POST as $key => $value){
				${$key} = htmlentities(trim($value));
			}

			if($r = $user->login($username,$password)){
				if($r['userType'] === 'ADMIN'){
					redirectTo('admin.php');
				}
				elseif($r['userType'] === 'STANDARD'){
					redirectTo('dashboard.php');
				}
			}
			else{
				$msg =  toDangerText($user->error());
			}
		}
		else{
			$msg =  toMissingFields($errors);
		}
	}
?>
<?php require_once("includes/header.php");?>
<div class = "container-fluid hidden-xs">
	<div class = "row">
		<img src = "images/login.jpg" class = "background img-responsive">
	</div>
</div>
<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.3);">
	<div class = "container">
		<div class = "row px20top">
			<div class = "col-lg-7 col-md-7 col-sm-12 col-xs-12">
				<div class = "big_text">
					<h1>Welcome home</h1>
					<h3>As you log in, please feel free to check out the new and improved features</h3>
					<h4><br /><a href = "aboutUs.php" class = "link">Read about us <i class = "fa fa-book"></i></a><br /><br /></h4>
				</div>
			</div>
			<div class = "col-lg-5 col-md-5 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-body">
						<div class = "page-header" style = "color:rgba(71,97,124,1.0);">
							<h3>Login</h3>
							<p><?php echo $msg;?> &nbsp;</p>
							<form action = "login.php" method = "post">
								<div class = "form-group">
									<label for = "username">Username</label>
									<input type = "text" class = "form-control" value = "<?php if(isset($username) && !empty($username)){echo $username;}?>" id = "username" name = "username" aria-required = "required" required  placeholder = "username" />
								</div>
								<div class = "form-group">
									<label for = "password">Password</label>
									<input type = "password" class = "form-control" id = "password" name = "password" aria-required = "required" required placeholder = "password" />
								</div>
								<a href = "index.php" class = "btn btn-info"><i class = "fa fa-arrow-circle-left"></i> Back</a>
								<button type = "submit" name = "submit" class = "btn btn-success" id = "submit_info" style = "float:right">Log in <i class = "fa fa-sign-in"></i></button>
								<p style = "margin-top:20px;"><a href = "signup.php">Create account</a> <a href = "signup.php" style = "float:right;">Forgot password?</a></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$("#username").focus();
	});
</script>
<?php require_once("includes/plain-footer.php");?>
