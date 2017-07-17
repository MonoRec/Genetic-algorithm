<?php 

require_once 'db.php';


class ShippersModel  {
	
	public function __construct() {
		$this->db = new DataBase();
	}

	public function getShippersList() {
		try {
			return $this->db->runQuery("
				SELECT * FROM shippers 
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

}