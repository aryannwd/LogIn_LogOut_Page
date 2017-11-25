<?php
	class Connection {

		public function getConnection(){
			$server_address = "localhost";
			$username = "root";
			$password = "";
			$database_name = "angular_app";

			$conn = new mysqli($server_address, $username, $password, $database_name) or die (
					$conn -> error.__LINE__);
			return $conn;
		}
	}

	class Database {
			//// members of the class here.
		private $conn = null;

			// constructor
		public function __construct(){
				$Connection = new Connection();
				$this->conn = $Connection->getConnection();
		}

		public function authenticate($username, $password, $remember_me){
	// the username can be email here.

			$password = md5($password);
			$query = "select * from user where email = '".$username. "' and password = '".$password."' limit 1";
			$result = $this->conn->query($query);
			if($result->num_rows > 0){
				$row = $result->fetch_assoc();
				$this->set_session($row);
				if ($remember_me) {
					$this->set_cookie($row);
				}
					
				$response['username'] = $row['username'];
					$response['id'] = $row['id'];
			}else{
					$response['username'] = '';
					$response['id'] = '';
			}
				return $response;
		}

		public function is_cookie_set(){
			if(isset($_COOKIE['id'])){
				$data['id'] = $_COOKIE['id'];
				$data['username'] = $_COOKIE['username'];
				$this->set_session($data);
				return true;
			}
			return false;
		}

		public function set_cookie($data = ''){
			$expiration_date = time() + 1800;
			setcookie("id", $data['id'], $expiration_date, "/");
			setcookie("username", $data['username'], $expiration_date, "/");
		}

		public function set_session($data = ''){
			if(!isset($_SESSION)){
				session_start();
			}
		
			if(!empty($data)){
				$_SESSION['username'] = $data['username'];
				$_SESSION['id'] = $data['id'];
			}
		}
		public function get_session_data(){
			if (!isset($_SESSION)) {
				session_start();
			}

			if (isset($_SESSION['id'])) {
				$data['id'] = $_SESSION['id'];
				$data['username'] = $_SESSION['username'];
			}else{
				$data['id'] = '' ;
				$data['username'] = '' ;
			}
			return $data;
		}

		public function logout(){
			$this->unset_cookie();
			if (!isset($_SESSION)) {
				session_start();
				
			}
			unset($_SESSION['id']);
			unset($_SESSION['username']);
			session_destroy();
		}

		public function unset_cookie(){
			if (isset($_COOKIE['id'])) {
				$expiration_date = time() - 3600;
				setcookie(("id", "", $expiration_date, "/"));
				setcookie("username", "",  $expiration_date, "/");
			}
		}
	}

?>