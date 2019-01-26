<?php
	if(!isset($_SESSION['mkulimaAdminDetails']) || empty($_SESSION['mkulimaAdminDetails'])){
		if(isset($_SESSION['mkulimaUserDetails']) && !empty($_SESSION['mkulimaUserDetails'])){
			redirectTo('dashboard.php');
		}
		
		else{
			redirectTo('logout.php');
		}	
	}
	else{
		$sessionDetails = $_SESSION['mkulimaAdminDetails'];
	}
?>