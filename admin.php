<?php 
	$name = "admin"; 
	require_once("includes/core.inc.php");
	require_once("includes/adminSession.inc.php");
	
	require_once 'includes/header.php';
	
?>

<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container">
		<div class = "row">
			<nav></nav>
		</div>
		
		<div class = "row">
			<div class = "col-lg-9">
				<div class = "row items_container" style = "margin-top:20px;">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>Stats</h4>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures registered_users"><?php echo $user->getCount('registered') ?></div>
								<div class = "item_description">Registered Users</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item" style = "color:#1b8649;">
							<div class  = "item_logo" style = "background-color:#2ecc71;">
								<span class = "fa fa-circle"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures users_onlines"><?php echo $user->getCount('onlineNow') ?></div>
								<div class = "item_description">Online now</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-thumbs-up"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures active_products"><?php echo $product->getCount('activeProducts')?></div>
								<div class = "item_description">Active Products</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item" style = "color:#1b5e20;">
							<div class  = "item_logo" style = "background-color:#4caf50;">
								<span class = "fa fa-dollar"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures price_sum"><span style = "font-size:0.5em">KES <?php echo $product->getCount('priceSum');?></span></div>
								<div class = "item_description">Worth of products</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item" style = "color:#b71c1c;">
							<div class  = "item_logo" style = "background-color:#e53935;">
								<span class = "fa fa-ban"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures inactive_products"><?php echo $product->getCount('inactiveProducts')?></div>
								<div class = "item_description">Inactive Products</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-list"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures total_products"><?php echo $product->getCount('totalProducts') ?></div>
								<div class = "item_description">Products ever Posted</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class = "col-lg-3">
				<div class = "sidebar_container">
					<div class = "sidebar_header">
						<h4>Graph</h4>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<script type = "text/javascript" language = "Javascript" src = "js/chart.min.js"></script>
<?php require_once 'includes/admin_footer.php';?>