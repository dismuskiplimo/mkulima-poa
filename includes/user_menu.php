<div class = "menu open">
	<a href = "<?php echo load_profile_image($sessionDetails['imgUrl']);?>" title = "<?php echo $sessionDetails['fname'] ." ". $sessionDetails['lname'];?>" class = "pretty">
		<img class = "img-responsive img-circle prof" src = "<?php echo load_profile_image($sessionDetails['imgUrl']);?>" alt = "<?php echo $sessionDetails['fname'] ." ". $sessionDetails['lname'];?>" />
	</a>
	<h4 class = "hidden-xs" style = "padding-left:40px;"><?php echo $sessionDetails['fname'] ." ". $sessionDetails['lname'];?></h4>
	<div class = "links_container">
		<ul class = "links">
			<li><a href = "dashboard.php" title = "Dashboard" <?php if($name === "dashboard"){echo "class = \"active\"";}?>><span class = "glyphicon glyphicon-dashboard"></span> <span class = "hidden-xs">DASHBOARD</span></a></li>
			<li><a href = "messages.php"  title = "Messages" <?php if($name === "messages"){echo "class = \"active\"";}?>><span class = "glyphicon glyphicon-envelope"></span> <span class = "hidden-xs">MESSAGES</span></a></li>
			<li><a href = "sell.php" title = "Sell Products" <?php if($name === "sell products"){echo "class = \"active\"";}?>><span class = "glyphicon glyphicon-usd"></span> <span class = "hidden-xs">SELL PRODUCTS</span></a></li>
			<li><a href = "my_bought_products.php" title = "My Products" <?php if($name === "my bought products"){echo "class = \"active\"";}?>><span class = "glyphicon glyphicon-eye-open"></span> <span class = "hidden-xs">BOUGHT PRODUCTS</span></a></li>
			
			<li><a href = "account.php" title = "My account" <?php if($name === "account"){echo "class = \"active\"";}?>><span class = "glyphicon glyphicon-user"></span> <span class = "hidden-xs">ACCOUNT</span></a></li>
			<li><a href = "logout.php" class = "logout" title = "Logout"><span class = "glyphicon glyphicon-off"></span> <span class = "hidden-xs">LOGOUT</span></a></li>
		</ul>
	</div>
	<div class = "toggle close" title = "Show menu"> 
		<span class="fa fa-reorder"></span>
	</div>
</div>