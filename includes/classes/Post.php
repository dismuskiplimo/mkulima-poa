<?php
	class Post extends DB{
		public function newPost($post, $author_id){
			$query = "INSERT INTO posts(post, author_id) VALUES(?,?)";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param("ss", $post,$author_id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows > 0){
					return 1;
				}
				else{
					$this->_error = 'Post not added, please try again';
				}
			}
			else{
				$this->_error = mysqli_error($db);
			}
		}
		
		public function getPost($id){
			$query = "SELECT posts.id, posts.post, posts.date_posted, users.fname, users.lname, users.username, users.img_url, users.thumb_url 
					  FROM posts 
					  LEFT JOIN users 
					  ON posts.author_id = users.id 
					  WHERE posts.id = ? 
					  AND posts.visibility = 1 
					  ORDER BY date_posted 
					  DESC ";
			
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('s', $id);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($post_id, $post_text, $post_date, $poster_fname, $poster_lname, $poster_username, $poster_img_url, $poster_thumb_url);
					
					while($statement->fetch()){
						$post = array(
							'id' => $post_id,
							'text' => $post_text,
							'date' => $post_date,
							'fname' => $poster_fname,
							'lname' => $poster_lname,
							'username' => $poster_username,
							'imgUrl' => $poster_img_url,
							'thumbUrl' => $poster_thumb_url
						);
					}
					
					return $post;
				}
				
				else{
					$this->_error = 'No posts yet';
				}
			}
			
			else{
				$this->_error = 'Something\'s wrong with the query';
			}
		}
		
		public function getPosts(){
			$query = "SELECT posts.id, posts.post, posts.date_posted, users.fname, users.lname, users.username, users.img_url, users.thumb_url 
					  FROM posts 
					  LEFT JOIN users 
					  ON posts.author_id = users.id 
					  WHERE posts.visibility = 1 
					  ORDER BY date_posted 
					  DESC ";
			
			$statement = $this->_conn->prepare($query);
			
			if($statement->execute()){
				$statement->store_result();
				if($statement->num_rows > 0){
					$statement->bind_result($post_id, $post_text, $post_date, $poster_fname, $poster_lname, $poster_username, $poster_img_url, $poster_thumb_url);
					$posts = array();
					
					while($statement->fetch()){
						$posts[] = array(
							'id' => $post_id,
							'text' => $post_text,
							'date' => $post_date,
							'fname' => $poster_fname,
							'lname' => $poster_lname,
							'username' => $poster_username,
							'imgUrl' => $poster_img_url,
							'thumbUrl' => $poster_thumb_url
						);
					}
					
					return $posts;
				}
				
				else{
					$this->_error = 'No posts yet';
				}
			}
			
			else{
				$this->_error = 'Something\'s wrong with the query';
			}
		}
		
		public function newComment($post_id, $comment, $author_id){
			$query = "INSERT INTO comments(post_id, comment, author_id) VALUES(?,?,?)";
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('sss', $post_id, $comment, $author_id);
			if($statement->execute()){
				$statement->store_result();
				if($statement->affected_rows == 1){
					return 1;
				}
				else{
					$this->_error = 'Sorry the comment was not added';
				}
			}
			else{
				$this->_error= 'Something\'s wrong with the query';
			}
		}
		
		public function getComments($id){
			$query = "SELECT comments.comment, comments.date_posted, users.fname, users.lname, users.username, users.img_url, users.thumb_url 
					  FROM comments 
					  LEFT JOIN users 
					  ON comments.author_id = users.id 
					  WHERE post_id = ? 
					  AND visibility = 1 
					  ORDER BY date_posted 
					  ASC ";
			
			$statement = $this->_conn->prepare($query);
			$statement->bind_param('i', $id);
			
			if($statement->execute()){
				$statement->store_result();
				
				if($statement->num_rows > 0){
					$statement->bind_result($comment_text,$comment_date, $comentee_fname, $comentee_lname, $comentee_username, $comentee_img_url, $comentee_thumb_url);
					$comments = array();
					
					while($statement->fetch()){
						$comments[] = array(
							'text'=>$comment_text,
							'date'=>$comment_date,
							'fname'=>$comentee_fname,
							'lname'=>$comentee_lname,
							'username'=>$comentee_username,
							'imgUrl'=>$comentee_img_url,
							'thumbUrl'=>$comentee_thumb_url
						);
					}
					
					return $comments;
				}
				else{
					$this->_error= 'No comments yet';
				}
			}
			
			else{
				$this->_error= 'Something\'s wrong with the query';
			}
		}
	}
?>