<?php


require_once 'db.php';



class CategoryModel {


public function __construct() {
		$this->db = new DataBase();
	}

	public function getCategories() {
		try {
			return $this->db->runQuery("
					SELECT * FROM categories	
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

}

?>