<?php $name = "users bought products"?>
<?php 
	require_once("includes/core.inc.php");
	require_once("includes/adminSession.inc.php");
	
	require_once 'includes/header.php';
?>

<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container">
	
		<div class = "row">
			<div class = "col-lg-9">
				<div class = "row items_container">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>BOUGHT PRODUCTS <span class = "pull-right">TIME : <?php echo date('h:i d-m-Y')?></span></h4>
						</div>
						
						
						<?php 
							
							
							if($products = $product->getSoldProducts()){
								
								echo '<table class = "table table-hover active_products">';
									echo '<tr>
											<th>PRODUCT ID</th>
											<th>PRODUCT NAME</th>
											<th>BUYER NAME</th>
											<th><span class = "no-print">BUYER USERNAME</span></th>
											<th>DATE POSTED</th>
											<th>PRICE</th>
											
										 </tr>';
									foreach($products as $p){
										echo '<tr>';
											echo '<td>#' . $p['id'] . '</td>';
											echo '<td>' . $p['name'] . '</td>';
											echo '<td>' . $p['fname'] . ' ' . $p['lname'] . '</td>';
											echo '<td><a class = "no-print" title = "'.$p['fname'] . ' ' . $p['lname'] .'" href = "profile.php?username='. htmlentities($p['username']) .'">' . $p['username'] . '</a></td>';
											echo '<td>' . check_date($p['datePosted']).', '. check_time($p['datePosted']) . '</td>';
											echo '<td>KES ' . number_format($p['price']) . '</td>';
											
										echo '</tr>';
									}
								echo '</table>';
							}
							else{
								die($product->error());
							}
						?>
							
							<p><button class = "btn btn-info no-print" type = "button" id = "print"><i class = "glyphicon glyphicon-print"></i> PRINT </button></p>
					</div>
				</div>
			</div>
			<div class = "col-lg-3 no-print">
				
			</div>
		</div>
	</div>
</div>
<?php require_once 'includes/admin_footer.php';?>