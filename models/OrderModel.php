<?php

require_once 'db.php';

class OrderModel {

	public function __construct() {
		$this->db = new DataBase();
	}

	public function update_status($val) {
		try {	
			return $this->db->runQuery("
				UPDATE orders 
				SET status='1'
				WHERE order_id=$val
				");
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}

	public function get_my_orders_count($id,$table,$col) {
		try {
			return $this->db->runQuery("
				SELECT COUNT($col) AS count FROM $table
				WHERE $col=$id;
				");
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}

	public function getOrdersList() {
		$id = self::verify($_SESSION['user_session']);
		try {
			return $this->db->runQuery("
				SELECT *
				FROM orders
				INNER JOIN order_detail 
				ON orders.order_id=order_detail.orders_id
				INNER JOIN shippers 
				ON orders.shippers_id=shippers.shippers_id
				INNER JOIN products 
				ON order_detail.products_id=products.product_id		
				INNER JOIN categories
				ON products.category_id=categories.category_id
				INNER JOIN suppliers 
				ON products.supplier_id=suppliers.supplier_id
				WHERE customer_id = $id
				");		
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}

	public function verify($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	public function add_order() {

		try {

			$error = "";
			$type = 			self::verify($_POST["type"]);
			$productID = 		self::verify($_POST["product_id"]);
			$userID = 			self::verify($_SESSION["user_session"]);	
			$description = 		self::verify($_POST["description"]);
			$quantity = 		(int)preg_replace("/[^\d]+/","",$_POST["quantity"]);
			$product_quantity = (int)preg_replace("/[^\d]+/","",$_POST["product_quantity"]);		
			$balance = 			$product_quantity - $quantity;
			
			$a = array(
				$_POST['addressDelivery'],
				array('Lat' => ($_POST['lat-order'])),
				array('Lng' => ($_POST['lng-order']))
				);
			
			$Location_order = json_encode($a);
			$Location_order = mysql_real_escape_string($Location_order);
			
			if($type == "") {
				$error = "Please select delivery type";
			} elseif($quantity == "") {
				$error = "Please select quantity";
			} elseif($_POST['address'] == "") {
				$error = "Please select address";
			} else {

				$this->db->runQuery("
					INSERT INTO orders (customer_id, shippers_id, delivery_address) 
					VALUES ($userID,$type, '$Location_order')
					");

				$this->db->runQuery("INSERT INTO order_detail (orders_id, products_id, quantity,  message) 
					VALUES((SELECT order_id FROM orders ORDER BY `order_id` DESC LIMIT 1), $productID, $quantity, '$description')");

				$this->db->runQuery("
					UPDATE products 
					SET quantity='$balance'
					WHERE product_id=$productID
					");

				return true;
			}
			return $error;
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}
}
?>