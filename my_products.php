<?php 
	$name = "my products";
	require_once("includes/core.inc.php"); 
	require_once("includes/userSession.inc.php");

	if(isset($_GET['id']) && !empty($_GET['id'])){
		$id = $_GET['id'];
		
		if($r = $product->getProduct($id)){
			if($product->removeProduct($id)){
				$msg = '<span class = "text-success" style = "text-shadow:0">' . $r['name'] . ' removed from market :)</span>';
			}
			else{
				$msg = '<span class = "text-danger" style = "text-shadow:0">' . $product->error() . '</span>';
			}
		}
	}
?>
<?php require_once("includes/header.php");?>
<?php require_once("includes/user_menu.php");?>
<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container" >
		<div class = "row px20top">
			<div class = "col-lg-3 col-md-3 col-sm-12 col-xs-12">
				
			</div>
			<div class = "col-lg-9 col-md-9 col-sm-12 col-xs-12">
				<div class = "panel panel-default">
					<div class = "panel-body">
						<div class = "" style = "color:rgba(71,97,124,1.0);">
							<div class = "hundred" style = "min-height:400px;">
								<h3>Here, you'll find the products you've posted for sale</h3>
								<p><?php echo $msg;?> &nbsp;</p>
								<div class = "hundred">
									<img src = "" alt = "" class = "img-responsive" />
									<?php
										if($prod = $product->selectMyProducts($sessionDetails['id'])){
											$details = '';
											
											foreach($prod as $item){
												$details .= '<a href = "item.php?id=' . $item['id'] . '">
																<div class = "chatbox hundred hov">
																	<p style = "line-height:50px;">
																		<img style = "width:50px; margin-right:10px;" class = "img-responsive img-circle fl_l" src = "' . load_product_image($item['thumbUrl']) . '" />
																		<span> ' . $item['name'] .'</span><span class = "fl_r">' . date('j M Y g:i A', strtotime($item['datePosted'])) . '</span>
																	</p>
																	<p>
																		<span class = "fl_r" style = "font-size:1.3em; font-weight:bold;">KES ' . $item['price'] . '</span>
																	</p>
																</div>
															</a> 
															<p>
																<span class = "fl_r" style = "margin-bottom:15px;">Already sold '. $item['name'] .'? 
																	<span class = "glyphicon glyphicon-hand-up"></span> 
																	<a class = "btn btn-success" href = "?id=' . htmlentities($item['id']) . '">yes</a>
																</span>
															<p>';
											}
											
											echo $details;
										}
										
										else{
											echo '<h4>You have not posted anything yet :(</h4>';
											echo '<p>Navigate to sell products on the left menu to start selling</p>';
										}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>