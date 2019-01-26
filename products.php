<?php $name = "products"?>
<?php 
	require_once("includes/core.inc.php");
	require_once("includes/adminSession.inc.php");

	
	if(isset($_POST['submit_cat'])){
		
		if(!empty($_POST['cat'])&& isset($_POST['cat'])){
			$category = ucfirst(htmlentities($_POST['cat']));
			if($product->categoryAvailable($category)){
				
				if($product->addCategory($category)){
					$cat_msg = '<p class = "text-success">'.$category.' added :)</p>';
					$category = "";
				}
				else{
					$cat_msg = '<p class = "text-danger">'.$product->error().' added :)</p>';
				}
				
			}else{
				$cat_msg = '<p class = "text-danger">' . $product->error() . '</p>';
			}
		}
		else{
			$cat_msg = '<p class = "text-danger">Please fill in before submitting</p>';
		}
	}
	
	
	if(isset($_POST['submit_sub'])){
		
		if(!empty($_POST['prod_category'])&& isset($_POST['prod_category'])){
			if(!empty($_POST['prod_sub_category'])&& isset($_POST['prod_sub_category'])){
				$cat = ucfirst(htmlentities($_POST['prod_category']));
				$sub_category = ucfirst(htmlentities($_POST['prod_sub_category']));
				
				if($product->subCategoryAvailable($sub_category)){
					if($product->addSubCategory($cat, $sub_category)){
						$sub_cat_msg = '<p class = "text-success">'.$sub_category.' added :)</p>';
						$sub_category = "";
					}
					else{
						$sub_cat_msg = '<p class = "text-danger">' . $product->error() . ' added :)</p>';
					}
				}else{
					$sub_cat_msg = '<p class = "text-danger">' . $product->error() . '</p>';
				}			
			}else{
				$sub_cat_msg = '<p class = "text-danger">Please fill in the sub category submitting</p>';
			}
		}
		
		else{
			$sub_cat_msg = '<p class = "text-danger">Please choose a category before submitting</p>';
		}
	}
	
	
	
	if(isset($_POST['submit_remove_cat'])){
		if(!empty($_POST['prod_category']) && isset($_POST['prod_category'])){
			$cat_id = htmlentities($_POST['prod_category']);
			
			if($product->removeCategory($cat_id)){
				$remove_cat_msg = '<p class = "text-success"> Category removed :)</p>';
			}
			
			else{
				$remove_cat_msg = '<p class = "text-danger">' . $product->error() . '</p>';
			}
		}
		else{
			$remove_cat_msg = '<p class = "text-danger">Please choose a category before submitting</p>';
		}
	}
	
	if(isset($_POST['submit_remove_sub'])){
		if(!empty($_POST['prod_sub_category']) && isset($_POST['prod_sub_category'])){
			$sub_id = htmlentities($_POST['prod_sub_category']);
			if($product->removeSubCategory($sub_id)){
				$remove_sub_msg = '<p class = "text-success">Sub category removed :)</p>';
			}
			
			else{
				$remove_sub_msg = '<p class = "text-danger">' . $product->error() . '</p>';
			}
		}else{
			$remove_sub_msg = '<p class = "text-danger">Please choose a sub category before submitting</p>';
		}
	}
	
	
	$total_products  = $product->getCount('totalProducts');
	$active_products  = $product->getCount('activeProducts');
	$inactive_products  = $product->getCount('inactiveProducts');
	$posted_today  = $product->getCount('postedToday');
	

	require_once 'includes/header.php';
?>

<div class = "container-fluid" style = "background-color:rgba(71,97,124,0.1);">
	<div class = "container">
		<div class = "row">
			<nav></nav>
		</div>
		
		<div class = "row">
			<div class = "col-lg-9">
				<div class = "row items_container no-print" style = "margin-top:20px;">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>Manage products</h4>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures active_products"><?php echo $active_products ?></div>
								<div class = "item_description">Active Products</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures total_products"><?php echo $total_products ?></div>
								<div class = "item_description">Products ever posted</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures total_products"><?php echo $inactive_products ?></div>
								<div class = "item_description">Inactive products</div>
							</div>
						</div>
					</div>
					<div class = "col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class = "admin_item">
							<div class  = "item_logo">
								<span class = "fa fa-user"></span>
							</div>
							<div class  = "item_content">
								<div class = "item_figures total_products"><?php echo $posted_today ?></div>
								<div class = "item_description">Products posted today</div>
							</div>
						</div>
					</div>
				</div>
				<div class = "row items_container">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>Active Products <span class = "pull-right"><?php echo date('h:i d-m-Y')?></span></h4>
						</div>
						<?php 
							
							
							if($products = $product->getAllProducts('active')){
								
								echo '<table class = "table table-hover active_products">';
									echo '<tr>
											<th>Product id</th>
											<th>Name</th>
											<th><span class = "no-print">Uploader</span></th>
											<th>Date posted</th>
											<th>Price</th>
											
										 </tr>';
									foreach($products as $p){
										echo '<tr>';
											echo '<td>' . $p['id'] . '</td>';
											echo '<td>' . $p['name'] . '</td>';
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
						
					</div>
				</div>
				<div class = "row items_container">
					<div class = "col-lg-12">
						<div class = "header">
							<h4>Inactive Products <span class = "pull-right"><?php echo date('h:i d-m-Y')?></span></h4>
						</div>
						
						<?php 
							if($products = $product->getAllProducts('inactive')){
								
								echo '<table class = "table table-hover active_products">';
									echo '<tr>
											<th>Product id</th>
											<th>Name</th>
											<th><span class = "no-print">Uploader</span></th>
											<th>Date posted</th>
											<th>Price</th>
											
										 </tr>';
									foreach($products as $p){
										echo '<tr>';
											echo '<td>' . $p['id'] . '</td>';
											echo '<td>' . $p['name'] . '</td>';
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
				<div class = "sidebar_container">
					<div class = "sidebar_header">
						<h4>Add a new category</h4>
					</div>
					<div class = "sidebar_content">
						<form action = "" method = "post">
							<input type = "text" name = "cat" value = "<?php echo isset($category) ? $category : "" ;?>" placeholder = "category" class = "form-control">
							<button type = "submit" name = "submit_cat" style = "margin:10px 0;" class = "btn btn-warning btn-sm">Add category</button>
						</form>
						<?php echo isset($cat_msg) ? $cat_msg : "";?>
					</div>
				</div>
				<div class = "sidebar_container">
					<div class = "sidebar_header">
						<h4>Add a new sub category</h4>
					</div>
					<div class = "sidebar_content">
						<form action = "" method = "post">
							<label for = "prod_category">Select Category</label>
							<select name = "prod_category" id = "prod_category" class = "form-control">
								<option value = "" selected> - Select category - </option>
								<?php
									//select categories from the category table
									if($products = $product->selectCategories()){
										foreach($products as $p){
											echo '<option value = "' . $p['category'] . '">' . $p['category'] . '</option>';
										}
									}else{
										echo '<option value = "">' . $product->error() . '</option>';
									}
									
								?>
							</select>
							<input type = "text" value = "<?php echo isset($sub_category) ? $sub_category : "";?>" name = "prod_sub_category" placeholder = "sub category" style = "margin:10px 0;" class = "form-control">
							<button type = "submit" name = "submit_sub" style = "margin-bottom:10px;" class = "btn btn-warning btn-sm">Add sub category</button>
						</form>
						<?php echo isset($sub_cat_msg) ? $sub_cat_msg : "";?>
					</div>
				</div>
				<div class = "sidebar_container">
					<div class = "sidebar_header">
						<h4>Remove category</h4>
					</div>
					<div class = "sidebar_content">
						<form action = "" method = "post">
							<label for = "prod_category">Select Category</label>
							<select name = "prod_category" id = "prod_category" class = "form-control">
								<option value = "" selected> - Select category - </option>
								<?php
									//select categories from the category table
									if($products = $product->selectCategories()){
										foreach($products as $p){
											echo '<option value = "' . $p['id'] . '">' . $p['category'] . '</option>';
										}
									}else{
										echo '<option value = "">' . $product->error() . '</option>';
									}
								?>
							</select>
							<button type = "submit" id = "submit_remove_cat" name = "submit_remove_cat" style = "margin:10px 0;" class = "btn btn-danger btn-sm">Remove category</button>
						</form>
						<?php echo isset($remove_cat_msg) ? $remove_cat_msg : "";?>
					</div>
				</div>
				<div class = "sidebar_container" style = "margin-bottom:20px;">
					<div class = "sidebar_header">
						<h4>Remove sub category</h4>
					</div>
					<div class = "sidebar_content">
						<form action = "" method = "post">
							<label for = "prod_sub_category">Select sub category</label>
							<select name = "prod_sub_category" id = "prod_sub_category" class = "form-control">
								<option value = "" selected> - Select sub category - </option>
								<?php
									//select categories from the sub category table
									
									if($categories = $product->selectCategories()){
										foreach($categories as $c){
											echo '<optgroup label = "' . $c['category'] . '">';
											
											if($subCategories = $product->selectSubCategories($c['category'])){
												foreach($subCategories as $s){
													echo '<option value = "' . $s['id'] . '">' . $s['subCategory'] . '</option>';
												}
											
											}
											else{
												echo '<option value = "">' . $product->error() . '</option>';
											}
											
											echo '</optgroup>';
											
										}
									}else{
										echo '<option value = "">' . $product->error() . '</option>';
									}
								
								?>
							</select>
							<button type = "submit" id = "submit_remove_sub" name = "submit_remove_sub" style = "margin:10px 0;" class = "btn btn-danger btn-sm">Remove sub category</button>
						</form>
						<?php echo isset($remove_sub_msg) ? $remove_sub_msg : "";?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once 'includes/admin_footer.php';?>