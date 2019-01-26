<?php
	if(isset($_SESSION['mkulimaUserDetails']) && !empty($_SESSION['mkulimaUserDetails'])){
		$sessionDetails = $_SESSION['mkulimaUserDetails'];
		require_once 'userHeader.php';
	}
	
	elseif(isset($_SESSION['mkulimaAdminDetails']) && !empty($_SESSION['mkulimaAdminDetails'])){
		$sessionDetails = $_SESSION['mkulimaAdminDetails'];
		require_once 'adminHeader.php';
	}
	
	else{
		require_once 'defaultHeader.php';
	}
?>