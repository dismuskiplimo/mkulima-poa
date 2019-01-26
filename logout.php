<?php
	require_once("includes/core.inc.php");
	unset($_SESSION['mkulima_id']);
	unset($_SESSION['mkulima_fname']);
	unset($_SESSION['mkulima_lname']);
	unset($_SESSION['admin_id']);
	
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-(60*60*24*7), '/');
	}
	session_destroy();
	
	redirect_to("login.php");
?>