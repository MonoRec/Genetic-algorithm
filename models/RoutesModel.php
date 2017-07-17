<?php

require_once 'db.php';


class RoutesModel {

	public function __construct() {
		$this->db = new DataBase();
	}

	public function verify($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	public function add() {
		$id = isset($_SESSION["user_session"]) ? $_SESSION["user_session"] : null;
		$places = ($_POST["places"]);
		try {
			return $this->db->runQuery("
				INSERT INTO routes (delivery_places,supplier_id) 
				VALUES ('$places',$id)
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

	public function getRoutesById() {
		$id = isset($_SESSION["user_session"]) ? $_SESSION["user_session"] : null;
		try {
			return $this->db->runQuery("
				SELECT * FROM routes 
				WHERE supplier_id = {$id}
				ORDER BY date DESC
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

}
?>