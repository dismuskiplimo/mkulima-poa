<?php $name = "search"?>
<?php require_once("includes/core.inc.php");?>
<?php 
	if(isset($_GET['search']) && !empty($_GET['search'])){
		$tag = $_GET['search'];
		$title = "Search results for <strong>'$tag'</strong>";
		$txt = "";
		$output = "";
		
		if($products = $product->search($tag)){
			$output.= '<table class = "table table-hover">';
				$output.= '<tr class = "info">';
					$output.= '<th></th>';
					$output.= '<th>Name</th>';
					$output.= '<th>Date posted</th>';
					$output.= '<th>Price</th>';
					$output.= '<th></th>';
				$output.= '</tr>';
			
			foreach($products as $prod){
					$output .= '<tr>';
						$output.= '<th style = "width:60px;overflow:hidden;">
										<a href = "item.php?id=' . $prod['productId'] . '&url=' . urlencode($tag) . '">
											<img class = "img-circle" style = "height:60px; width:auto;" src = "' . load_product_image($prod['imgUrl']) . '" alt = "' . $prod['productName'] . '" />
										</a>
									</th>';
						$output .= '<td style = "line-height:60px;">'. $prod['productName'] .'</td>';
						$output .= '<td style = "line-height:60px;">'. check_date(date('d-m-Y', strtotime($prod['datePosted']))).", ". date('g:i A', strtotime($prod['datePosted'])) .'</td>';
						$output .= '<td style = "line-height:60px;">KES '. $prod['price'] .'</td>';
						$output .= '<td style = "line-height:60px; text-align:right">
										<a style = "text-shadow:none;" class = "btn btn-info" href = "item.php?id=' . $prod['productId'] . '&url=' . urlencode($tag) . '"> 
											<span class = "glyphicon glyphicon-eye-open"></span> VIEW 
										</a>
									</td>';
					$output .= '</tr>';
					
			}
			
			$output.= '</table>';
		}
		
		else{
			$output = '<p>' . $product->error() . '</p>';
		}
	}
	
	else{
		$tag = "";
		$output = "<p>Search now to find your products or <a href = \"search.php?search=all\" style = \"text-shadow:none\">View all products</a></p> <br />";
		$title = "Type in your desired product to begin searching";
	}
?>
<?php require_once("includes/header.php");?>
<div class = "container">
	<div class = "row" >
		<div class = "col-lg-12 center">
			<h1><?php echo $title;?></h1>
		</div>
	</div>
	<div class = "row">
		<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class = "space">
				<form action = "" method = "get" style = "width:300px; margin:0 0;">
					<input type = "text" class = "form-control" style = "width:80%;float:left;" value = "<?php echo $tag;?>" name = "search" required placeholder = "product" />
					<span class="input-group-btn">
						<button class = "btn btn-default" type = "submit"> <span class = "glyphicon glyphicon-search"></span> </button>
					</span>
				</form>
			</div>
		</div>
	</div>
</div>
<div class = "container">	
	<div class = "row radius" style = "padding-top:20px">
		<div class = "col-lg-12">
			<?php echo $output;?>
		</div>
	</div>
</div>
<?php require_once("includes/plain-footer.php");?>