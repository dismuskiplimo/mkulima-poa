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
		<div class = "container">
			<nav class = "navbar navbar-default navbar-fixed-top">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><span class = "text-shadow">MKULIMA POA</span></a>
				</div>
				<div class="collapse navbar-collapse" id="collapse1">
					<ul class="nav navbar-nav">
						<li <?php if($name=='home'){echo 'class="active"';}?>><a href="index.php"><i class = "fa fa-home"></i> Home</a></li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class = "fa fa-info-circle"></i> Useful Links <span class="caret"></span></a>
							<ul class="dropdown-menu">
								
								<li><a href="http://www.kilimo.go.ke">Ministry of agriculture</a></li>
								<li><a href="http://www.meteo.go.ke">Meteriological department</a></li>
							</ul>
						</li>
						<li <?php if($name=='Weather forecast'){echo 'class="active"';}?>><a href="weather_forecast.php"><i class = "fa fa-cloud"></i> Weather forecast</a></li>
						<li <?php if($name=='market'){echo 'class="active"';}?>><a href="market.php"><i class = "fa fa-money"></i> Market</a></li>
						<li <?php if($name=='Discussion'){echo 'class="active"';}?>><a href="discussion.php"><i class = "fa fa-wechat"></i> Discussion forum</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right" style = "margin-right:0;">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <img src = "<?php echo load_profile_image($sessionDetails['thumbUrl']);?>" alt = "<?php echo $sessionDetails['fullName']?>" class = "navbar-img img-circle" /> <?php echo $sessionDetails['fullName']?></a>
							<ul class="dropdown-menu">
								<li><a href="dashboard.php"><i class = "fa fa-tachometer"></i> DASHBOARD</a></li>
								<li><a href="messages.php"><i class = "fa fa-envelope"></i> Messages</a></li>
								<li><a href="logout.php" class = "logout"><i class = "glyphicon glyphicon-log-out"></i> Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>