<?php

require_once 'db.php';

class ProfileModel {

	public function __construct() {
		$this->db = new DataBase();
	}

	public function verify($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function update() {

		$id = $_SESSION["user_session"];
		
		if(isset($_POST["btn-update"])) {
			$name = isset ($_POST["name"]) ?  $_POST["name"] :  "";
			$phone = isset ($_POST["phone"]) ?  $_POST["phone"]: "";
			$status = isset ($_POST["comp2"]) ?  $_POST["comp2"]: "";
			$surname = isset ($_POST["surname"]) ? $_POST["surname"]: "";
			$company_id = isset ($_POST["company-id"]) ? $_POST["company-id"]:"";
			$company_fax = isset ($_POST["company-fax"]) ? $_POST["company-fax"]: "";
			$suppliers_id = isset ($_POST["suppliers-id"]) ? $_POST["suppliers-id"]: "";
			$company_name = isset ($_POST["company-name"]) ? $_POST["company-name"]: "";
			$company_phone = isset ($_POST["company-phone"]) ? $_POST["company-phone"]: "";
			$company_location = isset ($_POST["company-location"]) ? $_POST["company-location"]: "";
			$company_description = isset ($_POST["company-description"]) ? $_POST["company-description"]: "";
			try {
				if($_SESSION["user_type"] == 0) {
					$this->db->runQuery("
						UPDATE suppliers
						SET first_name = '$name', second_name = '$surname', phone = '$phone'
						WHERE supplier_id = $id
						");
					$this->db->runQuery("
						UPDATE companies
						SET company_name = '$company_name', short_company_description = '$company_description', company_address = '$company_location', company_phone = '$company_phone',fax = '$company_fax'
						WHERE company_id = $company_id
						");
					return true;
				} else {
					$this->db->runQuery("
						UPDATE customers
						SET first_name = '$name', last_name = '$surname', phone = '$phone'
						WHERE customer_id = $id
						");
					return true;
				}
				return false;
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
	
	public function getUsetDetails () {
		try {	
			$id = self::verify($_SESSION["user_session"]);
			if($_SESSION["user_type"] == 0) {
				return $this->db->runQuery("
					SELECT * FROM suppliers
					LEFT JOIN companies ON suppliers.company_ID=companies.company_id
					WHERE supplier_id = $id
					");
			} else if ($_SESSION["user_type"] == 1){
				return $this->db->runQuery("
					SELECT * FROM customers
					WHERE customer_id = $id
					");
			} else {
				return false;
			}
		} catch(PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function resetPassword () {
		try {

			$id = self::verify($_SESSION["user_session"]);

			if(isset($_POST["btn-password"])) {

				$password = 	self::verify($_POST["password"]);
				$newPassword = 	self::verify($_POST["newPassword"]);
				$cnfPassword = 	self::verify($_POST["cnfPassword"]);

				$password = md5($password);
				$userPassword = md5($newPassword);

				if($_SESSION["user_type"] == 0 && $newPassword == $cnfPassword) {
					$check = $this->db->runQuery("SELECT * FROM suppliers WHERE password = '$password'");	
					if($check != false) {
						$this->db->runQuery("
							UPDATE suppliers
							SET password = '$userPassword'
							WHERE supplier_id = $id
							");
						return true;
					} else {
						return false;
					}

				} else if ($_SESSION["user_type"] == 1 && $newPassword == $cnfPassword) {
					
					$check = $this->db->runQuery(" SELECT * FROM customers WHERE password = '$password'");
					if($check) {
						$this->db->runQuery("
							UPDATE customers
							SET password = '$userPassword'
							WHERE customer_id = $id
							");
						return true;
					} else {
						return false;
					}

				}

			}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
?>
