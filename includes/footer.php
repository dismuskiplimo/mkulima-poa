		<div class = "container-fluid px20top">
			<div class = "container">
				<div class = "row center">
					<p style = "font-size:4em;">
						<a href = "#"><span class = "fa fa-facebook-square"></span></a> 
						<a href = "#"><span class = "fa fa-twitter-square"></span></a> 
						<a href = "#"><span class = "fa fa-google"></span></a> 
					</p>
					<p>Copyright&copy; <?php echo date('Y')?> Mkulima poa </p>
				</div>
			</div>
			<div class = "back_to_top hidden"> <span class = "glyphicon glyphicon-chevron-up"></span> </div>
		</div>
		<script type = "text/javascript" language = "Javascript" src = "js/jquery.easing.1.3.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/jquery.dataTables.min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/jquery.nicescroll.min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/bootstrap.min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/stellar.min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/jquery.matchHeight-min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/jquery.fancybox.pack.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/sweetalert.min.js"></script>
		<script type = "text/javascript" language = "Javascript" src = "js/functions.js"></script>
		<?php if(logged_in()){require_once("includes/navbar.php");}?>
		<?php
		if(logged_in()){
			echo '<script type = "text/javascript" language = "Javascript" src = "js/chat/chat.js"></script>';
		}
		?>
		<?php if(logged_in()){require_once("js/chat/chatBox.php");}?>
	</body>
</html>