<?php 
	
	$name = "dashboard";
	require_once("includes/core.inc.php"); 
	require_once("includes/userSession.inc.php"); 
	
	$sessionDetails = $_SESSION['mkulimaUserDetails'];

	if(isset($_GET['msg']) && $_GET['msg'] === "ff2e"){
		$msg = '<span class = "text-success" style = "text-shadow:0">Successfully posted <a href = "discussion.php#recent" >Click here to view</a></span>';
	}
	
	if(isset($_POST['post'])){
		if(isset($_POST['content']) && !empty($_POST['content'])){
			$text = htmlentities(trim($_POST['content']));
			
			if($post->newPost($text, myId())){
				redirectTo('dashboard.php?msg=ff2e');
			}
			else{
				$msg = '<span class = "text-danger" style = "text-shadow:0">' . $post->error() . '</span>';
			}
		}
		else{
			$msg = '<span class = "text-danger" style = "text-shadow:0">Please write something before postiong</span>';
		}
	}
	
	require_once("includes/header.php");
	require_once("includes/user_menu.php");
?>

<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container">
		<div class = "row px20top">
			<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
			</div>
			<div class = "col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-body">
						<div class = "" style = "color:rgba(71,97,124,1.0);">
							<h3>@<?php echo $sessionDetails['username'];?></h3>
							<div class = "hundred">
								<p>Feel free to post a question, complement or a piece of advice to your fellow farmers. Anything posted will appear in the discussion forum </p>
								<p><?php if(isset($msg) && !empty($msg)){echo $msg;}?> &nbsp;</p>
								<form action = "#" method = "post" class = "margin_tp">
									<textarea class = "form-control" name = "content" aria-required = "required" required></textarea>
									<button class = "btn btn-info margin_tp fl_r" name = "post">Post</button>
								</form>
							</div>
							<h4>What would you like to do?</h4>
							<div class = "hundred">
								<div class = "quarter"><a class = "blue" href = "sell.php"><span class = "glyphicon glyphicon-usd"></span> <br />Sell products</a></div>
								<div class = "quarter"><a class = "blue" href = "advertise.php"><span class = "glyphicon glyphicon-bullhorn"></span> <br />Advertise</a></div>
								<div class = "quarter"><a class = "blue" href = "account.php"><span class = "glyphicon glyphicon-user"></span> <br />View account</a></div>
								<div class = "quarter"><a class = "red red_bg logout" href = "logout.php"><span class = "glyphicon glyphicon-off"></span> <br /> Logout</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>