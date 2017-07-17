<?php 

require_once 'db.php';
// require_once 'model/ValidationException.php';

class OrderDetailModel {
	
	public function __construct() {
		$this->db = new DataBase();
	}

// SELECT name, count(name) AS visits
// FROM visits
// WHERE visitor = 1
// GROUP BY name
// ORDER BY visits DESC LIMIT 1;


// SELECT DISTINCT *, (SELECT COUNT(*) FROM order_detail WHERE products_ID = products.product_ID) AS ordersCount 
// 				FROM products
// 				LEFT JOIN categories 
// 				ON products.Category_ID=categories.category_ID 
// 				WHERE supplier_ID = {$id}

	// public function getOrderOffers($id) {
	// 	try {
	// 		$query = $this->runQuery("
	// 			SELECT * FROM order_detail
	// 			LEFT JOIN products 
	// 			ON products.product_ID = order_detail.products_ID 
	// 			LEFT JOIN categories 
	// 			ON categories.category_ID  = products.category_ID 
	// 			LEFT JOIN orders 
	// 			ON orders.order_ID = order_detail.orders_ID 
	// 			LEFT JOIN customers 
	// 			ON customers.customer_id = orders.customer_ID 
	// 			WHERE products_ID=$id
	// 			");
	// 		return $query;	
	// 	} catch (Exception $e) {
	// 		$this->closeDb();
	// 		throw $e;
	// 	}

	// 	var_dump($id);
	// }

	public function select() {
		try {
			$query = $this->db->runQuery("	
				SELECT *, count(products_ID) AS orderCount, (
				SELECT COUNT(*) FROM order_detail WHERE products_ID = products.product_ID) AS orders_count 
				FROM order_detail 
				LEFT JOIN products 
				ON products.product_ID = order_detail.products_ID 
				WHERE products.quantity > 0
				GROUP BY products_ID 
				ORDER BY orderCount DESC LIMIT 5
				");
			return $query;	
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}
	
	public function getOrderOffers($id) {
		try {
			$query = $this->db->runQuery("
				SELECT * FROM order_detail
				LEFT JOIN products 
				ON products.product_ID = order_detail.products_ID 
				LEFT JOIN categories 
				ON categories.category_ID  = products.category_ID 
				LEFT JOIN orders 
				ON orders.order_ID = order_detail.orders_ID 
				LEFT JOIN customers 
				ON customers.customer_id = orders.customer_ID 
				WHERE products_ID=$id
				");
			return $query;	
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}

		var_dump($id);
	}

}