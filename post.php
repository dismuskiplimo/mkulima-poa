<?php $name = "discussion forum"?>
<?php require_once("includes/core.inc.php");?>
<?php
	if(isset($_GET['post']) && !empty($_GET['post'])){
		$post_id = $_GET['post'];
		
		$p = $post->getPost($post_id);
		
		if(!$p){
			redirectTo("discussion.php");
		}
	}
	else{
		redirectTo("discussion.php");
	}
	
	if(isset($_GET['msg']) && $_GET['msg'] === "ff2e"){$msg = "<span class = \"text-success\" style = \"text-shadow:0\">Successfully posted</span>";}
	
	if(isset($_POST['comment'])){
		if(isset($_POST['content']) && !empty($_POST['content'])){
			$comment = htmlentities(trim($_POST['content']));
			
			if($post->newComment($post_id, $comment, myId())){
				redirect_to("post.php?msg=ff2e&post=$post_id");
			}
			
			else{
				$msg = $post->error();
			}
		}
		else{
			$msg = '<span class = "text-success" style = "text-shadow:0">Please write something before postiong</span>';
		}
	}

	require_once("includes/header.php");
?>
<div class = "container">
	<div class = "row  px20top dark-light radius" style = "margin-top:60px;">
		<div class = "col-lg-8 clo-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
			<div class = "row">
				<?php
					$author = empty($p['fname']) ? 'anonymous' : '<a href = "profile.php?username=' . htmlentities(urlencode($p['username'])) . '">' . $p['fname'] . '  ' . $p['lname'] . '</a>';
					
					echo '
						<div class = "chatbox">
							<div class = "image">
								<a href = "' . load_profile_image($p['imgUrl']) . '" class = "pretty">
									<img class = "img-responsive img-circle" src = "' . load_profile_image($p['thumbUrl']) . '" alt = "$author"/>
								</a>
							</div>
							<div class = "content">
								<p><strong>' . $author . '</strong><span class = "fl_r"><strong>' . check_date($p['date']).", ". check_time($p['date']). '</strong></span><p>
								<p>' . $p['text'] . '</p>
							</div>';
							
							if($comments = $post->getComments($post_id)){
								
								foreach($comments as $c){
									$comment_author = empty($c['fname']) ? 'anonymous' : '<a href = "profile.php?username=' . htmlentities(urlencode($c['username'])) . '">' . $c['fname'] . '  ' . $c['lname'] . '</a>';
									
									echo '
									<div class = "reply">
										<div class = "image">
											<a href = "' . load_profile_image($c['imgUrl']) . '" class = "pretty">
												<img class = "img-responsive img-circle" src = "' . load_profile_image($c['thumbUrl']) . '" alt = ""/>
											</a>
										</div>
										<div class = "content">
											<p><strong>' . $comment_author . '</strong> <span class = "fl_r">'. check_date($c['date']).", ". check_time($c['date']) .'</span></p>
											<p>' . $c['text'] . '</p>
										</div>
									</div>';
								}
							}
							else{
								echo '<div class = "reply">
										<p>' . $post->error() . '</p>
									</div>';
							}							
				?>
						<div class = "reply">
							<p><?php if(isset($msg) && !empty($msg)){echo $msg;}?> &nbsp;</p>
							<form action = "#" method = "post">
								<textarea class = "form-control" name = "content"></textarea>
								<a class = "btn btn-warning fl_l margin_tp" href = "discussion.php">Back</a>
								<button class = "btn btn-info margin_tp fl_r" type = "submit" name = "comment"> Comment</button>
							</form>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
<?php require_once("includes/footer.php");?>