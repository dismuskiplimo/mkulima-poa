<?php

	$name = "sell products";
	require_once("includes/core.inc.php"); 
	require_once("includes/userSession.inc.php"); 
	
	if(isset($_GET['msg']) && $_GET['msg'] === "ff2e"){$msg = "<span class = \"text-success\" style = \"text-shadow:0\">Successfully posted</span>";}
	
	if(isset($_POST['post_product'])){
		$required_fields = array("prod_name" => "Product name","prod_category" => "Product Category", "prod_description" => "Product Description", "email" => "email", "phone" => "Phone number", "price" => "price");
		$errors = array();
		foreach($required_fields as $field => $detail){
			if(!isset($_POST[$field]) or empty($_POST[$field])){
				$errors[] = $detail;
			}
		}
		if(empty($errors)){
			$img_url = '';
			$thumb_url = '';
			
			if(isset($_FILES['prod_img']['name'])){
				if(!$img_url = upload_picture('prod_img')){
					$img_url = '';
				}
			}
			else{
				$img_url = '';
			}
			
			if(!empty($img_url)){
				$initial_image_path = "images/uploads/" . $img_url;
				$final_image_path = "images/uploads/main_" . $img_url;
				$final_image = "main_" . $img_url;
				$final_thumb_path = "images/uploads/thumb_" . $img_url;
				$final_thumb = "thumb_" . $img_url;
				
				
				create_square_image($final_image_path,$initial_image_path,400);
				create_square_image($final_thumb_path,$initial_image_path,80);
				$thumb_url = $final_thumb;
				$img_url = $final_image;
				
				//delete uploaded image
				unlink($initial_image_path);
			}
			
			foreach($_POST as $key => $value){
				${$key} = htmlentities(trim($value));
			}
			
			
			if($product->addProduct($prod_name,$prod_category,$prod_description,$email,$phone,$price, $sessionDetails['id'],$img_url,$thumb_url)){
				redirect_to("sell.php?msg=ff2e");
			}
			else{
				$msg =  "<span class = \"text-danger\">Error) ". $product->error() ." </span>";
			}
		}
		else{
			$msg =  "<span class = \"text-danger\">please fill in the field(s) ". implode(" , ", $errors) ." </span>";
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
							<h3>Please enter your product details, there's a huge market out there</h3>
							<p><?php if(isset($msg) && !empty($msg)){echo $msg;}?> &nbsp;</p>
							<form class = "margin_tp" enctype = "multipart/form-data" action = "" method = "post">
								<div class = "form-group">
									<label for = "prod_img">Product image (maximum file size <?php echo ini_get('upload_max_filesize');?>B)</label>
									<input type = "file" id = "prod_img" name = "prod_img"/>
								</div>
								
								<div class = "row">
									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "prod_name">Product name</label>
											<input type = "text" id = "prod_name" required name = "prod_name" placeholder = "product name" class = "form-control" />
										</div>
									</div>
									
									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "prod_category">Product category</label>
											<select name = "prod_category" id = "prod_category" class = "form-control">
												<option value = "" selected> - please select a category - </option>
												<?php
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
										</div>
									</div>
								</div>
								
								<div class = "form-group">
									<label for = "price">Price</label>
									<input type = "number" id = "price" required name = "price" placeholder = "price" class = "form-control" />
								</div>
								
								<div class = "form-group">
									<label for = "prod_description">Product description</label>
									<textarea required name = "prod_description" id = "prod_description" placeholder = "product description, the more the description, the better your chances of getting a buyer" class = "form-control" /></textarea>
								</div>
								<div class = "row">
									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "email">email</label>
											<input type = "email" id = "email" name = "email" placeholder = "email" class = "form-control" />
										</div>
									</div>
									
									<div class = "col-lg-6">
										<div class = "form-group">
											<label for = "phone">Phone number</label>
											<input type = "number" id = "phone" required name = "phone" placeholder = "phone number" class = "form-control" />
										</div>
									</div>
								</div>
								<button class = "fl_r btn btn-info" type = "submit" name = "post_product">Sell</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require_once("includes/footer.php");?>