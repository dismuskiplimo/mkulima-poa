<!doctype html>
<html>
	<head>
		<title><?php if(isset($name) && !empty($name)){echo strtoupper($name);}?> | MKULIMA POA</title>
		<meta name = "viewport" content = "width = device-width, initial-scale = 1" />
		<meta charset = "utf-8" />
		<link rel = "Shortcut Icon" type = "Image/X-icon" href = "favicon.ico" />
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.min.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/font-awesome.min.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.min.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/animate.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.fancybox.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/fakeloader.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/sweetalert.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/styles.css" />
		<script type = "text/javascript" language = "Javascript" src = "js/jquery-1.11.3.min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/fakeloader.min.js"></script>
		<script src = "js/wow.min.js"></script>
	</head>
	<body>
		<div id="fakeLoader"></div>
		<div class = "container no-print">
			<nav class = "navbar navbar-default navbar-fixed-top">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="admin.php"><span class = "text-shadow">MKULIMA POA</span></a>
				</div>
				<div class="collapse navbar-collapse" id="collapse1">
					<ul class="nav navbar-nav">
						
						<li <?php if($name=='admin'){echo 'class="active"';}?>><a href="dashboard.php"><i class = "fa fa-tachometer"></i> DASHBOARD</a></li>
						<li <?php if($name=='users'){echo 'class="active"';}?>><a href="users.php"><i class = "fa fa-user"></i> USERS</a></li>
						<li <?php if($name=='products'){echo 'class="active"';}?>><a href="products.php"><i class = "fa fa-archive"></i> ALL PRODUCTS</a></li>
						<li <?php if($name=='users bought products'){echo 'class="active"';}?>><a href="bought_products.php"><i class = "fa fa-archive"></i> BOUGHT PRODUCTS</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right" style = "margin-right:0;">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <img src = "<?php echo load_profile_image($sessionDetails['thumbUrl']);?>" alt = "<?php echo $sessionDetails['fname'] ." ". $sessionDetails['lname']?>" class = "navbar-img img-circle" /> <?php echo $sessionDetails['fname'] ." ". $sessionDetails['lname']?></a>
							<ul class="dropdown-menu">
								<li><a href="admin.php"><i class = "fa fa-tachometer"></i> DASHBOARD</a></li>
								<li><a href="logout.php" class = "logout"><i class = "glyphicon glyphicon-log-out"></i> Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>