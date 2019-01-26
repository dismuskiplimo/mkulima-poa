<?php
	$name = isset($_GET['username']) && !empty($_GET['username']) ? '@' . $_GET['username'] : "@no_name";
	require_once("includes/core.inc.php");
	require_once("includes/header.php");
	
	$output = "";
	if(isset($_GET['username']) && !empty($_GET['username'])){
		$username = htmlentities($_GET['username']);
		
		if($d = $user->getUserDetails($username, 'username')){
			
			$names = $d['fname'] . ' ' . $d['lname'];
			$output.='<div class = "col-lg-4">';
				$output.='<a href = "' . load_profile_image($d['imgUrl']) . '" alt = "' . $names . '" title = "' . $names . '" class = "pretty">';
					$output.='<img class = "img-responsive" alt = "' . $names . '" src = "' .load_profile_image($d['imgUrl']). '">';
				$output.='</a>';
			$output.='</div>';
			
			$output.='<div class = "col-lg-8">';
				$output.='<table class = "table">';
				$output.='<tr>';
					$output.='<th>Names</th>';
					$output.='<td>' . $names . '</td>';
				$output.='</tr>';
				$output.='<tr>';
					$output.='<th>Date Registered</th>';
					$output.='<td>' . check_date($d['dateRegistered']) . '</td>';
				$output.='</tr>';
				if(logged_in()){
					$output.='<tr>';
						$output.='<th>Last Active</th>';
						$output.='<td>'.check_date($d['lastActiveTime']) .', '. check_time($d['lastActiveTime']).'</td>';
					$output.='</tr>';
					
					if($sessionDetails['id'] != $d['id']){
						$output.='<tr>';
							$output.='<th></th>';
							$output.='<td class = "right"><a href = "messages.php?action=compose&recepient=' . $username . '"><strong>Send message <span class = "fa fa-envelope"></span></strong></a></td>';
						$output.='</tr>';
					}
				}
				$output.='</table>';
			$output.='</div>';
			
		}else{
			$output = '<p>' . $user->error() . '</p>';
		}
	}
	else{
		$output.= '<p>No username selected</p>';
	}
?>
<?php ?>
<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container" >
		<div class = "row px20top">
			<div class = "col-lg-1 col-md-3 col-sm-12 col-xs-12">
				
			</div>
			<div class = "col-lg-11 col-md-9 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-body">
						<div class = "" style = "color:rgba(71,97,124,1.0);">
							<div class = "hundred" style = "min-height:400px;">
								<h3><?php echo $name;?></h3><br /><br />
								<div class = "row">
									<?php echo $output;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/plain-footer.php");?>