<?php
	class Product extends DB{
		public function addProduct($prod_name,$prod_category,$prod_description,$email,$phone,$price, $mkulima_id,$img_url,$thumb_url){
			$query = "INSERT INTO products(name,category,description,email,phone,price,uploader,img_url,thumb_url) VALUES(?,?,?,?,?,?,?,?,?)";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("sssssssss",$prod_name,$prod_category,$prod_description,$email,$phone,$price,$mkulima_id,$img_url,$thumb_url);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error =  'oops try again, the record wasnt inserted';
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function removeProduct($id){
			$query = 'UPDATE products SET visibility = 0 WHERE id = ?';
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Product not removed, please try again';
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function buyProduct($productId, $userId){
			$query = "UPDATE products SET status = 'SOLD', buyer = ? WHERE id = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('ss', $userId, $productId);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Product not bought, please try again';
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function selectMyProducts($id){
			$query = "SELECT id,name,date_posted,price,thumb_url FROM products WHERE buyer = ? AND status = 'SOLD' ORDER BY date_posted DESC";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($id,$name,$date_posted,$price,$thumb_url);
					
					$details = array();
					
					while($statement->fetch()){
						$details[] = array(
							'id'=> $id,
							'name'=> $name,
							'datePosted'=> $date_posted,
							'price'=> $price,
							'thumbUrl'=> $thumb_url
						);
					}
					
					return $details;
				}
				else{
					$this->_error = "No products yet";
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function getProduct($id){
			$query = "SELECT id,name,date_posted,price,thumb_url FROM products WHERE visibility = 1 AND id = ? ORDER BY date_posted DESC";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($id,$name,$date_posted,$price,$thumb_url);
						
					while($statement->fetch()){
						$details = array(
							'id'=> $id,
							'name'=> $name,
							'datePosted'=> $date_posted,
							'price'=> $price,
							'thumbUrl'=> $thumb_url
						);
					}
					
					return $details;
				}
				else{
					$this->_error = "Product not found";
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function getProducts(){
			$query = "SELECT id,name,date_posted,price,thumb_url FROM products WHERE visibility = 1 ORDER BY date_posted DESC";
			$statement = $this->_conn->prepare($query);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($id,$name,$date_posted,$price,$thumb_url);
					
					$details = array();
					
					while($statement->fetch()){
						$details[] = array(
							'id'=> $id,
							'name'=> $name,
							'datePosted'=> $date_posted,
							'price'=> $price,
							'thumbUrl'=> $thumb_url
						);
					}
					
					return $details;
				}
				else{
					$this->_error = "No products yet";
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function getItem($id){
			$query = "SELECT products.buyer,products.status,products.img_url, products.views, products.phone, products.email, products.description, products.date_posted, products.price, products.name , product_sub_category.category ,product_sub_category.sub_category, users.fname, users.lname, users.username, users.id  
				  FROM products 
				  LEFT JOIN product_sub_category 
				  ON products.category = product_sub_category.id 
				  LEFT JOIN users
				  ON products.uploader = users.id
				  WHERE products.id = ? 
				  AND visibility = 1  
				  LIMIT 1";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('i',$id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($buyer,$status, $prod_img, $prod_views, $prod_phone, $prod_email, $prod_description, $date_posted, $price, $prod_name, $prod_category, $prod_sub_category,$uploader_fname, $uploader_lname, $uploader_username, $uploader_id);
					
					while($statement->fetch()){
						$details = array(
							'buyer' => $buyer,
							'status' => $status,
							'imgUrl' => $prod_img,
							'views' => $prod_views,
							'phone' => $prod_phone,
							'email' => $prod_email,
							'description' => $prod_description,
							'datePosted' => $date_posted,
							'price' => $price,
							'name' => $prod_name,
							'category' => $prod_category,
							'subCategory' => $prod_sub_category,
							'fname' => $uploader_fname,
							'lname' => $uploader_lname,
							'username' => $uploader_username,
							'user_id' => $uploader_id
						);
					}
					
					return $details;
				}
				else{
					$this->_error = 'Product not found';;
				}
			}else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		
		public function getSoldProducts(){
			
			
			$query = "SELECT products.id, products.name, products.date_posted, products.price, users.fname, users.lname, users.username 
					  FROM products 
					  LEFT JOIN users 
					  ON products.buyer = users.id
					  WHERE status = 'SOLD'
					  ORDER BY date_posted DESC";
			$statement =  $this->_conn->prepare($query);
			
			if($statement->execute()){
				$statement->store_result();
				$statement->bind_result($id,$name,$date_posted,$price, $fname, $lname, $username);
				
				$products = array();
				
				while($statement->fetch()){
					$products[] = array(
						'id'=> $id,
						'name'=> $name,
						'datePosted'=> $date_posted,
						'price'=> $price,
						'fname'=> $fname,
						'lname'=> $lname,
						'username'=> $username
					);
				}
				
				return $products;
				
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
			
			
		}
		
		public function getAllProducts($type = 'active'){
			
			if($type == 'all'){
				$val = '0 OR 1';
			}
			
			elseif($type == 'active'){
				$val = '1';
			}
			
			elseif($type == 'inactive'){
				$val = '0';
			}
			
			
			else{
				$this->_error = 'Invalid argument';
				exit;
			}
			
			$query = "SELECT products.id, products.name, products.date_posted, products.price, users.fname, users.lname, users.username 
					  FROM products 
					  LEFT JOIN users 
					  ON products.uploader = users.id
					  WHERE visibility = $val
					  ORDER BY date_posted DESC";
			$statement =  $this->_conn->prepare($query);
			
			if($statement->execute()){
				$statement->store_result();
				$statement->bind_result($id,$name,$date_posted,$price, $fname, $lname, $username);
				
				$products = array();
				
				while($statement->fetch()){
					$products[] = array(
						'id'=> $id,
						'name'=> $name,
						'datePosted'=> $date_posted,
						'price'=> $price,
						'fname'=> $fname,
						'lname'=> $lname,
						'username'=> $username
					);
				}
				
				return $products;
				
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
			
			
		}
		
		public function search($tag){
			if($tag == 'all'){
				$query = "SELECT products.id AS 'prod_id', products.thumb_url, products.date_posted, products.price, products.name AS 'prod_name', product_sub_category.category AS 'prod_category',product_sub_category.sub_category AS 'prod_sub_category'
						  FROM products 
						  LEFT JOIN product_sub_category 
						  ON products.category = product_sub_category.id 
						  WHERE products.visibility = 1 AND products.status = 'AVAILABLE'  
						  ORDER BY products.date_posted DESC";
				$statement = $this->_conn->prepare($query);
				$url = 'all';
			}
			else{
				$like_string = $tag . "%";
				$query = "SELECT products.id AS 'prod_id', products.thumb_url, products.date_posted, products.price, products.name AS 'prod_name', product_sub_category.category AS 'prod_category',product_sub_category.sub_category AS 'prod_sub_category'
						  FROM products 
						  LEFT JOIN product_sub_category 
						  ON products.category = product_sub_category.id 
						  WHERE (products.name LIKE ?
						  OR product_sub_category.category LIKE ? 
						  OR product_sub_category.sub_category LIKE ? ) 
						  AND products.visibility = 1 AND products.status = 'AVAILABLE' 
						  ORDER BY products.date_posted DESC";
				$statement = $this->_conn->prepare($query);
				$statement->bind_param('sss',$like_string,$like_string,$like_string);
				$url = $tag;
			}
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($prod_id, $img_url, $date_posted, $price, $prod_name, $prod_category, $prod_sub_category);
					
					$data = array();
					
					while($statement->fetch()){
						$data[] = array(
							'productId'=> $prod_id,
							'imgUrl'=> $img_url,
							'datePosted'=> $date_posted,
							'price'=> $price,
							'productName'=> $prod_name,
							'productCategory'=> $prod_category,
							'productSubCategory'=> $prod_sub_category
						);
					}
					
					return $data;
				}
				else{
					$this->_error = 'No products';
				}
			}
			
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function addViews($id){
			$query = "UPDATE products SET views = views + 1 WHERE id = ?";
			$stat = $this->_conn->prepare($query);
			$stat->bind_param("i", $id);
			if($stat->execute()){
				$stat->store_result();
				if($stat->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'View not updated';
				}
			}
			else{
				$this->_error = mysqli_error($this->_conn);
			}
		}
		
		public function getCount($description){
		
			if($description == 'activeProducts'){
				$query = "SELECT * FROM products WHERE visibility = 1";
			}
			elseif($description == 'inactiveProducts'){
				$query = "SELECT * FROM products WHERE visibility = 0";
			}
			elseif($description == 'totalProducts'){
				$query = "SELECT * FROM products";
			}
			
			elseif($description == 'postedToday'){
				$query ="SELECT date_posted FROM products";
				$statement = $this->_conn->prepare($query);
				if($statement->execute()){
					$statement->store_result();
					$statement->bind_result($date);
					$count = 0;
					while($statement->fetch()){
						if(check_date($date)== "Today"){
							$count++;
						}
					}
					
					return $count;
				}
				
				else{
					$this->_error = 'Error in the query';
				}
				exit;
			}
			
			elseif($description == 'priceSum'){
				$query ="SELECT SUM(price) AS price FROM products";
				$statement = $this->_conn->prepare($query);
				if($statement->execute()){
					$statement->store_result();
					$statement->bind_result($price);
					while($statement->fetch()){
						$price = $price;
					}
					
					return $price;
				}
				else{
					$this->_error = 'Error in query';
				}
				exit;
			}
			
			else{
				$this->_error = 'Invalid argument';
				exit;
			}
			
			$statement = $this->_conn->prepare($query);
			if($statement->execute()){
				$statement->store_result();
				return $statement->num_rows;
			}
			else{
				$this->_error = 'Error in query';
			}
		}
		
		public function categoryAvailable($category){
			$query = "SELECT * FROM product_category WHERE category = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s",$category);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$this->_error = 'Category exists, please choose another';
				}else{
					return 1;
				}
			}else{
				$this->_error = mysqli_error($this->_conn);
			}
				
		}
		
		public function addCategory($category){
			$query = "INSERT INTO product_category(category) VALUES(?)";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s",$category);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Sorry, no changes made';
				}
			}
			else{
				$this->_error = 'Sorry, we had a problem connecting with our database';
			}
		}
		
		public function selectCategories(){
			$query = "SELECT `category`,`id` FROM `product_category` ORDER BY `category` ASC";
			$statement = $this->_conn->prepare($query);
			$categories = array();
			if($statement->execute()){
				$statement->store_result();
				
				if($statement->num_rows){
					$statement->bind_result($category,$id);
					$categories = array();
					
					while($statement->fetch()){
						$categories[] = array(
							'id'=>$id,
							'category'=>$category
						);
					}
					
					return $categories;
				}else{
					$this->_error = 'No categories available';
				}
			}
			else{
				$this->_error = mysqli_error($db);
			}
		}
		
		public function removeCategory($id){
			$query = "DELETE FROM product_category WHERE id = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("i",$id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Failed to remove sub category : No such category exists';
				}
			}
			else{
				$this->_error = mysqli_error($db);
			}
		}
		
		public function addSubCategory($cat, $sub_category){
			$query = "INSERT INTO product_sub_category(category,sub_category) VALUES(?,?)";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("ss",$cat,$sub_category);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Sorry, no changes made';
				}
			}
			else{
				$this->_error = 'Sorry, we had a problem connecting with our database';
			}
		}
		
		public function selectSubCategories($category){
			$query = "SELECT `id`,`sub_category` FROM `product_sub_category` WHERE `category` = ? ORDER BY sub_category ASC";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s',$category);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($id, $sub_category);
					$subCategories = array();
					
					while($statement->fetch()){
						$subCategories[] = array(
							'id'=>$id,
							'subCategory' => $sub_category
						);
					}
					
					return $subCategories;
				}else{
					$this->error = 'No sub category available';
				}	
			}
			else{
				$this->error = 'Query error';
			}
		}
		
		public function subCategoryAvailable($sub_category){
			$query = "SELECT * FROM product_sub_category WHERE sub_category = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("s",$sub_category);
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows < 1){
					return 1;
				}
				else{
					$this->_error = 'Sub category exists, please choose another';
				}
			}else{
				$this->_error = 'Sorry, we had a problem connecting with our database';
			}
		}
		
		public function removeSubCategory($sub_id){
			$query = "DELETE FROM product_sub_category WHERE id = ?";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("i",$sub_id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Failed to remove sub category : No such sub category exists';
				}
			}
			else{
				$this->_error = mysqli_error($db);
			}
		}
	}
	
?>