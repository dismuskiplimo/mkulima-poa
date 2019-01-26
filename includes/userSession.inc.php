<?php
	if(!isset($_SESSION['mkulimaUserDetails']) || empty($_SESSION['mkulimaUserDetails'])){
		if(isset($_SESSION['mkulimaAdminDetails']) && !empty($_SESSION['mkulimaAdminDetails'])){
			redirectTo('admin.php');
		}
		
		else{
			redirectTo('logout.php');
		}	
	}
	else{
		$sessionDetails = $_SESSION['mkulimaUserDetails'];
	}
?>