<?php $name = "users"?>
<?php 
	require_once("includes/core.inc.php");
	require_once("includes/adminSession.inc.php");
	
	require_once 'includes/header.php';
?>

<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container">
	
		<div class = "row">
			<div class = "col-lg-9">
				<div class = "row items_container no-print" style = "margin-top:20px;">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>Overall Stats</h4>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures registered_users"><?php echo $user->getCount('registered') ?></div>
								<div class = "item_description">Registered Users</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures users_online"><?php echo $user->getCount('onlineNow') ?></div>
								<div class = "item_description">Online now</div>
							</div>
						</div>
					</div>
				</div>
				<div class = "row items_container">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>Users <span class = "pull-right"><?php echo date('h:i d-m-Y')?></span></h4>
						</div>
						
						
							<?php
								
								
								if($users = $user->getAllUserDetails(myId())){
									echo '<table class = "table table-hover">
											<tr>
												<th></th>
												<th>Fname</th>
												<th>Lname</th>
												<th>Username</th>
												<th>Date Registered</th>
												<th>Gender</th>
												<th>Last Active</th>
											</tr>';
										foreach($users as $u){
											echo '<tr>
													<td><img  style = "width:40px; height:auto; margin-top:-10px" class = "img-circle" src = "' . load_profile_image($u['thumbUrl']) . '" alt = "' . $u['fname'] . ' ' . $u['lname'] . '" /></td>
													<td>' . $u['fname'] . '</td>
													<td>' . $u['lname'] . '</td>
													<td>' . $u['username'] . '</td>
													<td>' . check_date($u['dateRegistered']) . '</td>
													<td>' . $u['gender'] . '</td>
													<td>' . check_date($u['lastActiveTime']) . ', ' . check_time($u['lastActiveTime']). '</td>
												  </tr>';
										}
									echo '</table>';
								}
								
								else{
									echo $user->error();
								}
							?>
							
							<p><button class = "btn btn-info no-print" type = "button" id = "print"><i class = "glyphicon glyphicon-print"></i> PRINT </button></p>
					</div>
				</div>
			</div>
			<div class = "col-lg-3 no-print">
				<div class = "sidebar_container">
					<div class = "sidebar_header">
						<h4>Todays' Stats</h4>
					</div>
					<div class = "sidebar_content">
						<table class = "table table-stripped">
							<tr>
								<td>Online</td>
								<td><strong><?php echo $user->getUserCount('onlineToday');?> User(s)</strong></td>
							</tr>
							
							<tr>
								<td>Registered</td>
								<td><strong><?php echo $user->getUserCount('registeredToday');?> User(s)</strong></td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class = "sidebar_container">
					<div class = "sidebar_header">
						<h4>Yesterdays' Stats</h4>
					</div>
					<div class = "sidebar_content">
						<table class = "table table-stripped">
							<tr>
								<td>Online</td>
								<td><strong><?php echo $user->getUserCount('onlineYesterday');?> User(s)</strong></td>
							</tr>
							
							<tr>
								<td>Registered</td>
								<td><strong><?php echo $user->getUserCount('registeredYeaterday');?> User(s)</strong></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once 'includes/admin_footer.php';?>