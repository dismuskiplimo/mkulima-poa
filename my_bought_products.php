<?php 
	$name = "my bought products";
	require_once("includes/core.inc.php"); 
	require_once("includes/userSession.inc.php");

	if(isset($_POST['buyProduct'])){
		
		$productId = $_POST['id'];
		
		if($product->buyProduct($productId, $sessionDetails['id'])){
			$msg = 'Successfully bought product';
		}else{
			$msg = $product->error();
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
								<h3>Here, you'll find the products you've bought</h3>
								<p><?php echo $msg;?> &nbsp;</p>
								
								
									<?php
										if($prod = $product->selectMyProducts($sessionDetails['id'])){
											$details = '<table class = "table table-bordered">
															<tr>
																<th>NAME</th>
																<th>DATE</th>
																<th>PRICE</th>
															</tr>';
											
											foreach($prod as $item){
												
												$details .= '<tr>
																<td>' . $item['name'] . '</td>
																<td>' . date('j M Y g:i A', strtotime($item['datePosted'])) . '</td>
																<td>' . $item['price'] . '</td>
																
															</tr>';
											}
											
											$details .= '</table>';
											
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
<?php require_once("includes/footer.php");?>