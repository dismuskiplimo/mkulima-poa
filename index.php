<?php $name = "home"?>
<?php require_once("includes/core.inc.php");?>
<?php require_once("includes/header.php");
?>
<div class = "container-fluid">
	<div class = "row fullscreen" style = "">
		<h1><span id = "wss"></span></h1>
	</div>
</div>
<div class = "container-fluid" style = "background:#fff;">
	<div class = "row" style = "z-index:100;position:relative;">
		<div class = "col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 center">
			<h2 style = "padding-bottom:40px;margin-bottom:-40px; padding-top:40px; line-height:1.5em;" >
					LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM ADIPISCING TINCIDUNT EGESTAS. 
					DUIS PRETIUM LACUS A SAPIEN ULTRICIES DAPIBUS VEL SIT AMET ENIM.
			</h2>
		</div>
	</div>
	<div class = "row">
		<div class = "container">
			<div class = "row px20top" >
				<div class = "col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12 center" style = "border-bottom:1px solid #CCC; padding-bottom:80px;">
					<h3 style = "line-height:1.3em;">
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam adipiscing tincidunt egestas. 
						Duis pretium lacus a sapien ultricies dapibus vel sit amet enim. Suspendisse accumsan scelerisque turpis, 
						vitae sollicitudin dolor consequat eget. Maecenas molestie rhoncus dolor. Cras vehicula, dui a tristique 
						pellentesque, libero sapien interdum nibh, vel adipiscing quam ante nec lectus. Donec mattis suscipit porta. 
					</h3>
				</div>
			</div>
			<div class = "row px20top">
				<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 center">
					<div class = "row wow fadeInLeft" data-wow-duration = "1s">
						<a href = "weather_forecast.php"><span class = "glyphicon glyphicon-cloud" style = "font-size:8em;"></span></a>
						<h2>Weather forecast</h2>
						<h4>Sounds strange but we do it</h4>
						<h4><a href = "weather_forecast.php">Check weather now!</a></h4>
					</div>
				</div>
				
				<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 center">
					<div class = "row wow pulse" data-wow-duration = "1s">
						<a href = "market.php"><span class = "glyphicon glyphicon-usd" style = "font-size:8em;"></span></a>
						<h2>Sell with us</h2>
						<h4>Mkulima Poa is all about quality</h4>
						<h4><a href = "market.php">See posted products</a></h4>
					</div>
				</div>
				
				<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 center">
					<div class = "row wow fadeInRight" data-wow-duration = "1s">
						<a href = "signup.php"><span class = "glyphicon glyphicon-user" style = "font-size:8em;"></span></a>
						<h2>Not yet a member?</h2>
						<h4>Register with us to get more from our site</h4>
						<h4><a href = "signup.php">Register now</a></h4>
					</div>
				</div>
			</div>
		</div>
		<div class = "container-fluid dark">
			<div class = "container">
				<div class = "row px20top">
					<div class = "col-lg-8 col-md-8 col-sm-6">
						<h2>
							LOREM IPSUM DOLOR SIT AMET, CONSECTETUR ADIPISCING ELIT. ETIAM ADIPISCING TINCIDUNT EGESTAS.
						</h2>
						<h4>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam adipiscing tincidunt egestas. 
							Duis pretium lacus a sapien ultricies dapibus vel sit amet enim. Suspendisse accumsan scelerisque turpis, 
							vitae sollicitudin dolor consequat eget.
						</h4>
					</div>
					<div class = "col-lg-4 col-md-4 col-sm-6">
						<img class = "img-responsive img-drop" src = "images/lion.jpg" alt = "">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#fakeloader").fakeLoader({
			timeToHide:1200, //Time in milliseconds for fakeLoader disappear
			zIndex:"9999999",//Default zIndex
			spinner:"spinner1",//Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
			bgColor:"#2ecc71" //Hex, RGB or RGBA colors
			//imagePath:"yourPath/customizedImage.gif" //If you want can you insert your custom image
		});
	});
</script>

<?php require_once("includes/footer.php");?>