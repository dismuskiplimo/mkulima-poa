<?php 
	class DB{
		protected $_conn, 
				$_error,
				$_server = 'localhost',
				$_username = 'root',
				$_password = '',
				$_database = 'agri';
	
		public function error(){
			return $this->_error;
		}
		
		public function validateEmail($email){
			return (preg_match("/(@.*@)|(\.\.)|(@\.)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
		}
		
		public function __construct(){
			$this->_conn = new mysqli($this->_server, $this->_username, $this->_password, $this->_database);
			if($this->_conn->connect_errno){
				die($this->_conn->connect_error);
			}
			
			else{
				return $this->_conn;
			}
		}
	}
?>