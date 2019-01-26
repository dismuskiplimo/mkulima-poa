		<div class = "back_to_top hidden"> <span class = "glyphicon glyphicon-chevron-up"></span> </div>
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