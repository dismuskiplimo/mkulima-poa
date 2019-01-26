<?php
	
	function redirect_to($url){
		header("Location: $url");
		exit;
	}
	
	function redirectTo($url){
		header("Location: $url");
		exit;
	}
	
	function toMissingFields($errors){
		if(count($errors) > 1){
			$msg =  "<span class = \"text-danger\" style = \"text-shadow:none\>Please fill in the following fields before proceeding : <strong>".implode(" , ", $errors)."</strong></span>";
		}
		else{
			$msg =  "<span class = \"text-danger\" style = \"text-shadow:none\>Please fill in the following field before proceeding : <strong>".implode(" , ", $errors)."</strong></span>";
		}
		
		return $msg;
	}
	
	function toDangerText($text){
		$text =  "<span class = \"text-danger\" style = \"text-shadow:none\">" . $text . "</span>";
		return $text;
	}
	
	function check_date($date){
		$date = date('d-m-Y', strtotime($date));
		
		if($date == date('d-m-Y', time() + (1*24*60*60))){
			return "Tomorrow";
		}
		
		elseif($date == date('d-m-Y', time() + (2*24*60*60))){
			return date('l', time() + (1*24*60*60));
		}
		
		elseif($date == date('d-m-Y', time() + (3*24*60*60))){
			return date('l', time() + (1*24*60*60));
		}
		
		elseif($date == date('d-m-Y', time() + (4*24*60*60))){
			return date('l', time() + (1*24*60*60));
		}
		
		elseif($date == date('d-m-Y', time() + (4*24*60*60))){
			return date('l', time() + (1*24*60*60));
		}
		
		elseif($date == date('d-m-Y')){
			return "Today";
		}
		
		elseif($date == date('d-m-Y', time() -(1*24*60*60))){
			return "Yesterday";
		}
		else{
			return $date;
		}
	}
	
	function check_time($time){
		return date('g:i A', strtotime($time));
	}
	
	function logged_in(){
		if(isset($_SESSION['mkulimaUserDetails']) && !empty($_SESSION['mkulimaUserDetails'])){
			return 1;
		}
		else{
			return 0;
		}
	}
	function check_login(){
		if(!logged_in()){
			redirect_to("logout.php");
		}
	}
	
	
	function myId(){
		if(isset($_SESSION['mkulimaUserDetails']) && !empty($_SESSION['mkulimaUserDetails'])){
			return $_SESSION['mkulimaUserDetails']['id'];
		}
		elseif(isset($_SESSION['mkulimaAdminDetails']) && !empty($_SESSION['mkulimaAdminDetails'])){
			return $_SESSION['mkulimaAdminDetails']['id'];
		}
		else{
			return 0;
		}
	}
	
	
	function upload_picture($file){
		$return = array('errors' => 0, 'url' => '');
		
		if(($_FILES[$file]['type'] == "image/jpeg") || ($_FILES[$file]['type'] == "image/pjpeg") || ($_FILES[$file]['type'] == "image/gif") || ($_FILES[$file]['type'] == "image/png") && ($_FILES[$file]['size'] <= 2000000)){
			
			if($_FILES[$file]['type'] == "image/jpeg" || $_FILES[$file]['type'] == "image/pjpeg"){$ext = ".jpg";}
			if($_FILES[$file]['type'] == "image/png"){$ext = ".png";}
			if($_FILES[$file]['type'] == "image/gif"){$ext = ".gif";}
			
			if($_FILES[$file]['error'] > 0){
				return false;
			}
			else{
				$hand = $_FILES[$file]['name'];
				$handle = sha1($hand) . time() .$ext;
				if(file_exists("../images/uploads/" . $handle)){
					return false;
				}
				else{
					if(!file_exists("images/uploads/dont_delete.config")){
						move_uploaded_file($_FILES[$file]['tmp_name'], "../images/uploads/" . $handle);
					}
					else{
						move_uploaded_file($_FILES[$file]['tmp_name'], "images/uploads/" . $handle);
					}
					return $handle;
				}	
			}
		}
		else{
			return false;
		}
	}
	
	function create_square_image($destination,$source,$endsize = 400){
		$ext = pathinfo($source,PATHINFO_EXTENSION);				
		if($ext == "jpg"){
			$exif = exif_read_data($source);
			$image = imagecreatefromjpeg($source);	
		}
		
		elseif($ext == "gif"){
			$image = imagecreatefromgif($source);
		}
		
		elseif($ext == "png"){
			$image = imagecreatefrompng($source);
		}
		
		list($x,$y) = getimagesize($source);
		
		if($x > $y){
			$square = $y;
			$offsetX = ($x - $y) / 2;
			$offsetY = 0;
		}
		elseif($y > $x){
			$square = $x;
			$offsetX = 0;
			$offsetY = ($y - $x) / 2;
		}
		else{
			$square = $x;
			$offsetX = 0;
			$offsetY = 0;
		}
		
		$tn = imagecreatetruecolor($endsize, $endsize);
		imagecopyresampled($tn,$image,0,0,$offsetX,$offsetY,$endsize,$endsize,$square,$square);
		if(!empty($exif['Orientation'])){
			switch($exif['Orientation']){
				case 3:
					$tn = imagerotate($tn,180,0);
					imagealphablending($tn, TRUE);
					break;
				case 6:
					$tn = imagerotate($tn,-90,0);
					imagealphablending($tn, TRUE);
					break;
				case 8:
					$tn = imagerotate($tn,90,0);
					imagealphablending($tn, TRUE);
					break;
			}
		}	
		imagejpeg($tn,$destination,100);
	}
	
	function load_product_image($img){
		if(empty($img) || !file_exists("images/uploads/" . $img)){
			return "images/default.png";
		}
		else{
			return "images/uploads/" . $img;
		}
	}
	
	function load_profile_image($img){
		if(empty($img) || !file_exists("images/uploads/" . $img)){
			return "images/default.png";
		}
		else{
			return "images/uploads/" . $img;
		}
	}
	
	function userLoggedIn(){
		if(isset($_SESSION['mkulimaUserDetails']) && !empty($_SESSION['mkulimaUserDetails'])){
			return 1;
		}
	}
	
?>