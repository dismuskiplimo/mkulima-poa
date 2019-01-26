<?php $name = "Discussion";
 
	require_once("includes/core.inc.php");
	if(isset($_GET['msg']) && $_GET['msg'] === "ff2e"){$msg = "<span class = \"text-success\" style = \"text-shadow:0\">Successfully posted</span>";}
	if(isset($_POST['submit_post'])){
		if(isset($_POST['post']) && !empty($_POST['post'])){
			$text = htmlentities(trim($_POST['post']));
			
			if($post->newPost($text, myId())){
				redirect_to("discussion.php?msg=ff2e");
			}
			else{
				$msg = toDangerText($post->error());
			}
		}
		else{
			$msg = toDangerText("Please write something before posting");
		}
	}
	if(isset($_POST['submit_comment'])){
		if(isset($_POST['comment']) && !empty($_POST['comment'])){
			if(isset($_POST['post_id']) && !empty($_POST['post_id'])){
				$comment = htmlentities($_POST['comment']);
				$post_id = $_POST['post_id'];
				
				if($post->newComment($post_id, $comment, myId())){
					redirect_to("discussion.php?msg=ff2e");
				}
				else{
					$msg = toDangerText($post->error());
				}
			}
			else{
				$msg = toDangerText("Something's wrong with the post Id");
			}
		}
		else{
			$msg = toDangerText("You did not write any comment");
		}
	}
?>
<?php require_once("includes/header.php");?>
<div class = "container-fluid">
	<div class = "row" style = "">
		<img src = "images/discussion.jpg" alt = "" class = "img-responsive" title = "" style = "position:relative;margin-top:-60px;z-index:-20;" data-stellar-ratio = "0.1" />
	</div>
	<div class = "row px20top" style = "background:#fff;">
		<div class = "col-lg-12 center">
			<h1>WHERE THE GREATEST MINDS MEET</h1>
			<h4>POST A QUESTION, YOU'LL BE SURE TO GET A RESPONSE</h4>
		</div>
	</div>
</div>
<div class = "container">
	<div class = "row px20top dark-light radius">
		<div style = "width:90%; margin:0 5%;">
			<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class = "space">
					<div class = "row">
						<form action = "" method = "post">
							<textarea rows = "3" style = "width:100%" required aria-required = "required"  name = "post" class = "form-control"></textarea>
							<button type = "submit" class = "btn btn-info" name = "submit_post" style = "float:right; margin-top:20px;">Post Question</button>
						</form>
					</div>
					<div class = "row">
						<p><?php if(isset($msg) && !empty($msg)){echo $msg;}?> &nbsp;</p>
					</div>
				</div>
				<div class = "space">
					<div class = "row">
						<a name = "recent"></a>
						<h4>Recent posts</h4>
					</div>
				</div>
				<div class = "row">
					<div class = "space">
						<?php
							
							if($posts = $post->getPosts()){
								foreach($posts as $p){
									
									$author = empty($p['fname']) ? 'anonymous' : '<a href = "profile.php?username=' . htmlentities(urlencode($p['username'])) . '">' . $p['fname'] . '  ' . $p['lname'] . '</a>';
							
									echo '
										<div class = "chatbox">
											<div class = "image">
												<a href = "' . load_profile_image($p['imgUrl']) . '" class = "pretty">
													<img class = "img-responsive img-circle" src = "' . load_profile_image($p['thumbUrl']) . '" alt = ""/>
												</a>
											</div>
											<div class = "content">
												<p><strong>' . $author . '</strong><span class = "fl_r"><strong>' . check_date($p['date']).", ". check_time($p['date']) . '</strong></span><p>
												<p>' . $p['text'] . '</p>
											</div>';
												
											if($comments = $post->getComments($p['id'])){
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
																<p>' .$c['text']. '</p>
															</div>
														</div>';
												}
												
												echo	'<form action = "" method = "post" style = "margin-left:70px">
																<textarea class = "form-control" rows = "2" placeholder = "comment" name = "comment" style = "margin:35px 0 10px 0" required></textarea>
																<input type = "hidden" name = "post_id" value = "' . htmlentities($p['id']) . '">
																<p style = "padding:10px 0; width:40%;float:left"><a href = "post.php?post=' . urlencode($p['id']) . '">View full post</a></p>
																<button type = "submit" name = "submit_comment" class = "btn btn-warning fl_r">Comment</button>
															</form>';
																
											}
												
											else{
												echo '<div class = "reply">
														<p>' . $post->error() . '</p>
														<form action = "" method = "post" style = "margin-left:70px">
															<textarea class = "form-control" rows = "2" placeholder = "comment" name = "comment" style = "margin:35px 0 10px 0" required></textarea>
															<input type = "hidden" name = "post_id" value = "' . htmlentities($p['id']) . '">
															<button type = "submit" name = "submit_comment" class = "btn btn-warning fl_r">Comment</button>
														</form>
													</div>';
											}
										
									echo '</div>';		
								}
							}
											
							else{
								echo toDangerText($post->error());
							}
						?>
					</div>
				</div>
			</div>
			<div class = "col-lg-3 col-lg-offset-1 col-md-4 col-sm-12 col-xs-12">
				<div class = "row">
					<img src = "images/home.jpg" alt = "" class = "img-responsive radius" title = "" />
					<p>Here, we care about proper harvest </p>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>