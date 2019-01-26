<?php $name = "Item"?>
<?php require_once("includes/core.inc.php");?>
<?php 
	if(isset($_GET['id']) && !empty($_GET['id'])){
		$id = $_GET['id'];
		$output = "";
		
		if($prod = $product->getItem($id)){
			$output.= '<table class = "table">';
				$output .= '<tr><th>Date Posted</th><td>'. check_date(date('d-m-Y', strtotime($prod['datePosted']))).", ". date('g:i A', strtotime($prod['datePosted'])) .'</td></tr>';
				$output .= '<tr><th>Category</th><td>'. $prod['category'] .'</td></tr>';
				$output .= '<tr><th>Sub Category</th><td>'. $prod['subCategory'] .'</td></tr>';
				$output .= '<tr><th>Description</th><td>'. nl2br($prod['description']) .'</td></tr>';
				$output .= '<tr><th>Price</th><td>KES '. $prod['price'] .'</td></tr>';
				$output .= '<tr><th>Uploader </th><td><a style = "text-shadow:none;" href = "profile.php?username=' . htmlentities(urlencode($prod['username'])) . '">'. $prod['fname'] . " " . $prod['lname'] .'</a></td></tr>';
				$output .= '<tr><th>Contact Email</th><td>'. $prod['email'] .'</td></tr>';
				$output .= '<tr><th>Contact phone number</th><td>'. $prod['phone'] .'</td></tr>';
				$output .= '<tr><th>Buy Now</th><td>';
				if(userLoggedIn()){
					if($prod['status'] === 'AVAILABLE'){
						if($prod['username'] == $_SESSION['mkulimaUserDetails']['username']){
							$output .= '<span class = "text-danger">YOU CANNOT BUY WHAT YOU POSTED</span>';
						}
						else{
							$output .= '
								<form action = "my_bought_products.php" method = "POST">
									<input type = "hidden" value = "' . $id . '" name = "id" />
									<button type = "submit" name = "buyProduct" class = "btn btn-success">BUY NOW</button>
								</form>';
						}
						
					}else{
						$output .= '<span class = "text-danger">ALREADY BOUGHT</span>';
					}
					
					
				}else{
					$output .= '<span class = "text-danger">PLEASE LOG IN TO BUY</span>';
				}
				
				
				$output .= '</td></tr>';
			$output.= '</table>';
			
			
			$product->addViews($id);
			
			$prod['views'] = $prod['views'] + 1;
		}
		
		else{
			redirect_to('search.php');
		}
	}
	
	else{
		redirect_to('search.php');
	}
?>
<?php require_once("includes/header.php");?>
<div class = "container">
	<div class = "row" >
		<div class = "col-lg-12 center">
			<p style = "padding-top:20px;text-align:left"><a href = "search.php?search=<?php echo isset($_GET['url']) ? urlencode($_GET['url']) : urlencode('all');?>"><span class = "fa fa-arrow-left"></span> Back to results</a><span class = "fl_r">Views <strong><?php echo $prod['views'];?></strong></span></p>
			<h1><?php echo strtoupper($prod['name']); ?></h1><br />
		</div>
	</div>
	
	<div class = "row">
		<div class = "col-lg-4">
			<div class = "thumbnail">
				<?php 
					echo '<a href = "' . load_product_image($prod['imgUrl']) . '" title = "' . strtoupper($prod['name']) . '" class = "pretty">
							<img class = "img-responsive" style = "max-height:400px; margin:0px auto 0px auto;" src = "' . load_product_image($prod['imgUrl']) . '" alt = "' . $prod['name'] . '" />
						  </a>';
				?>
			</div>
		</div>
		
		<div class = "col-lg-8 dark-light radius">
			<div style = "width:94%; margin:20px 3% 0 3%;">
				<?php echo $output;?>
			</div>
		</div>
	</div>
	
	<div class = "row">
		
	</div>
	
</div>
<?php require_once("includes/plain-footer.php");?>