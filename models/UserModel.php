<?php

require_once 'db.php';
// require_once 'model/ValidationException.php';

class UserModel {

	public function __construct() {
		$this->db = new DataBase();
	}

	public function verify($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function checkLogin() {

		$flag = $_POST['flag'];
		$mail = strip_tags($_POST['email']);
		$password = md5(strip_tags($_POST['password']));
		try {
			if($flag) {
				$query = $this->db->runQuery("
					SELECT * FROM customers 
					WHERE email='$mail' AND password='$password'	
					");
				if($query){
					$_SESSION['user_type'] = 1;
					$_SESSION['user_session'] = $query[0]->customer_id;
					$_SESSION['user_surname'] =$query[0]->first_name;
					$_SESSION['user_name'] = $query[0]->second_name;
					return true;
				}
				return false;
			} else {
				$query = $this->db->runQuery("
					SELECT * FROM suppliers 
					WHERE email='$mail' AND password='$password'
					");
				if($query){
					$_SESSION['user_type'] = 0;
					$_SESSION['user_admin'] = $query[0]->status;
					$_SESSION['user_session'] = $query[0]->supplier_id;
					$_SESSION['user_surname'] = $query[0]->second_name;
					$_SESSION['user_name'] = $query[0]->first_name;
					return true;
				}
				return false;
			} 	

		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}


	public function remove() {
		
		$table = isset($_GET['table']) ? $_GET['table'] : NULL;
		$id = isset($_GET['id']) ? $_GET['id'] : NULL;
		
		try {
			if($table == 'suppliers') { 
				return $this->db->runQuery("
					DELETE FROM suppliers 
					WHERE supplier_id = $id			
					");
			} 
			if($table == "customers") {
				return $this->db->runQuery("
					DELETE FROM customers 
					WHERE customer_id = $id
					");
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function addUser() {

		$fname		 = self::verify($_POST["firstName"]);
		$sname		 = self::verify($_POST["secondName"]);	
		$mail		 = self::verify($_POST["email"]);
		$password	 = self::verify($_POST["password"]); 
		$cnfpassword = self::verify($_POST["cfmPassword"]); 
		$phone		 = self::verify($_POST["phone"]); 
		$comName	 = self::verify($_POST["companyName"]) ;
		$comAddress	 = self::verify($_POST["companyAddress"]);
		$comPhone	 = self::verify($_POST["companyPhone"]);
		$comFax		 = self::verify($_POST["companyFax"]);
		$comDesc	 = self::verify($_POST["companyDescription"]);

		$companyAddress = json_encode(array(
			$comAddress,
			array('Lat' => self::verify($_POST['positionLat'])),
			array('Lng' => self::verify($_POST['positionLng']))
			));
		
		$hashP = md5($password);

		$var = $this->db->runQuery("SELECT * FROM suppliers WHERE email='$mail' AND password ='$hashP'");
		$var2 = $this->db->runQuery("SELECT * FROM customers WHERE email='$mail' AND password ='$hashP'");
		// var_dump($var);
		$error = "Successfully registered";
		if(!isset($_POST["term-check"])) {
			$error = 'Please accept the <br> Terms of Service';
		} elseif( $fname == "" ) {
			$error = 'Enter your First & Second name';
		} elseif( $sname == "" ) {
			$error = 'Enter your Last name';
		} elseif( $fname == $sname ) {
			$error = 'First name and last name <br> cannot be same';
		} elseif( $password == "" ) {
			$error = 'Enter your password';
		} elseif( strlen($password) < 6 ) {
			$error = 'Password must be<br>  more than 6 characters';
		} elseif( $password != $cnfpassword ) {
			$error = 'Password and confirm password <br> does not match!';
		} elseif( $comAddress == "" ) {
			$error = 'Please enter address';
		} elseif( $mail == "" ) {
			$error = 'Please enter email';
		} elseif( $mail != "" && !preg_match( "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$mail ) ) {
			$error = 'Enter valid email';
		} elseif($var || $var2) {
			$error = 'The email address you entered is already registered ';
		} else {
			$password = md5($password);
			if($_POST["userType"]) {
				try {
					$this->db->runQuery("INSERT INTO customers (first_name, last_name,email, password,phone) VALUES ('$fname','$sname','$mail','$password','$phone')");
				} catch (Exception $e) {
					$this->closeDB();
					throw $e;
				}
			} else {
				try {
					$this->db->runQuery("INSERT INTO companies (company_name, short_company_description,company_address, company_phone,fax) VALUES ('$comName','$comDesc','$comAddress','$comPhone','$comFax')");
				} catch (Exception $e) {
					$this->closeDB();
					throw $e;
				}
				try {
					$this->db->runQuery("INSERT INTO suppliers (company_id, first_name, second_name, email, password, phone) VALUES ((SELECT company_id FROM companies ORDER BY `company_id` DESC LIMIT 1), '$fname','$sname','$mail','$password','$phone')");
				} catch (Exception $e) {
					$this->closeDB();
					throw $e;
				}
			}
		}

		return $error;
	}

	public function select() {
		
		$table = self::verify($_GET['table']);	
		try {
			if($table == 'suppliers') { 
				return $this->db->runQuery("
					SELECT * FROM suppliers 
					INNER JOIN companies
					ON companies.company_id = suppliers.company_id	
					");
			} 
			if($table == "customers") {
				return $this->db->runQuery("
					SELECT * FROM customers 
					");
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function selectById() {
		
		$id = self::verify($_GET['id']);
		$table = self::verify($_GET['table']);	
		try {
			if($table == 'suppliers') { 
				return $this->db->runQuery("
					SELECT * FROM suppliers 
					INNER JOIN companies
					ON companies.company_id = suppliers.company_id
					WHERE supplier_id = $id
					");
			} 
			if($table == "customers") {
				return $this->db->runQuery("
					SELECT * FROM customers 
					WHERE customer_id = $id
					");
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function update (){

		$id = self::verify($_GET['id']) ? $_GET['id'] : NULL;
		$table = self::verify($_GET['table']) ? $_GET['table'] : NULL;
		if(isset($_POST["btn-update"])) {
			
			$suppliers_id = self::verify(isset($_POST["suppliers-id"]) ? $_POST["suppliers-id"]:"");
			$name = self::verify(isset($_POST["name"]) ?  $_POST["name"] : "");
			$surname = self::verify(isset($_POST["surname"]) ? $_POST["surname"]:"");
			$username = self::verify(isset($_POST["username"]) ? $_POST["username"]:"");
			$phone = self::verify(isset($_POST["phone"]) ?  $_POST["phone"]:"");
			$company_id = isset($_POST["company-id"]) ? $_POST["company-id"]:"";
			$company_name = self::verify(isset($_POST["company-name"]) ? $_POST["company-name"]:"");
			$company_description = self::verify(isset($_POST["company-description"]) ? $_POST["company-description"]:"");
			$company_location = self::verify(isset($_POST["company-location"]) ? $_POST["company-location"]:"");
			$company_phone = self::verify(isset($_POST["company-phone"]) ? $_POST["company-phone"]:"");
			$company_fax = self::verify(isset($_POST["company-fax"]) ? $_POST["company-fax"]:"");
			$status = self::verify(isset($_POST["comp2"]) ?  $_POST["comp2"]:"");
			try {
				if($table == "suppliers") {
					$this->db->runQuery("
						UPDATE suppliers
						SET first_name = '$name', second_name = '$surname', username = '$username', phone = '$phone'
						WHERE supplier_id = $id
						");
					$this->db->runQuery("
						UPDATE companies
						SET company_name = '$company_name', short_company_description = '$company_description', company_address = '$company_location', company_phone = '$company_phone',fax = '$company_fax'
						WHERE company_id = $company_id
						");
				} 
				if($talbe="customers") {
					$this->db->runQuery("
						UPDATE customers
						SET first_name = '$name', last_name = '$surname', phone = '$phone'
						WHERE customer_id = $id
						");
				}
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}
?>