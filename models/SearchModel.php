<?php 

require_once 'db.php';

class SearchModel {

public function __construct() {
		$this->db = new DataBase();
	}

	public function getSearchResult() {
		$key = isset($_POST["search"]) ? $_POST["search"] : "" ;
		try {
			return $this->db->runQuery("
				SELECT * FROM products a
				INNER JOIN suppliers b
				ON a.supplier_id = b.supplier_id
				WHERE product_name LIKE '%$key%'
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}	
	}

}