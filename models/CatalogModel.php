<?php

require_once 'db.php';

class CatalogModel {

	public function __construct() {
		$this->db = new DataBase();
	}

	public function getCategories() {
		try {
			return $this->db->runQuery("
				SELECT  DISTINCT
				(SELECT COUNT(*) FROM products WHERE category_id = categories.category_id) AS Count,
				categories.category_name,
				categories.category_id
				FROM categories
				LEFT JOIN products
				ON categories.category_id = products.category_id
				ORDER BY Count DESC
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

	public function getOffersByCategory() {
		$id = isset($_GET["id"]) ? $_GET["id"] : "";
		try {
			if($id != "") {
				return $this->db->runQuery("
					SELECT * FROM products a
					INNER JOIN suppliers b
					ON a.supplier_id = b.supplier_id
					WHERE category_id={$id}
					");
			} else {
				return $this->db->runQuery("
					SELECT * FROM products a
					INNER JOIN suppliers b
					ON a.supplier_id = b.supplier_id
					");
			}
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

	public function getOfferDetail() {
		$id = isset($_GET["id"]) ? $_GET["id"] : "";
		try {
			return $this->db->runQuery("
				SELECT * FROM products 
				LEFT JOIN categories 
				ON products.Category_id=categories.category_id 
				LEFT JOIN suppliers 
				ON products.Supplier_id=suppliers.supplier_id
				WHERE product_id = {$id}
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}
}	
?>