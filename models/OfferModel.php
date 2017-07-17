<?php

require_once 'db.php';
// require_once 'model/ValidationException.php';

class OfferModel {

public function __construct() {
		$this->db = new DataBase();
	}
	

	public function getOrderOffers () {
		try {
			$id = isset($_GET['id']) ? $_GET['id'] : NULL;
			if(isset($id)) {
				return $this->db->runQuery("
					
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
			} else {
				return $this->db->runQuery("
					SELECT * FROM order_detail
					LEFT JOIN products 
					ON products.product_ID = order_detail.products_ID 
					LEFT JOIN categories 
					ON categories.category_ID  = products.category_ID 
					LEFT JOIN orders 
					ON orders.order_ID = order_detail.orders_ID 
					LEFT JOIN customers 
					ON customers.customer_id = orders.customer_ID
					ORDER BY product_name
					");
			}
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

	public function getProductsUser() {
		$id = $this->verify($_SESSION["user_session"]);
		try {
			return $this->db->runQuery("
				SELECT DISTINCT *, (SELECT COUNT(*) FROM order_detail WHERE products_id = products.product_id) AS ordersCount 
				FROM products
				LEFT JOIN categories 
				ON products.Category_id=categories.category_id 
				WHERE supplier_id = {$id}
				ORDER BY ordersCount DESC
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}	
	}

	public function get_my_offers_count($id,$table,$col) {
		try {
			$query = $this->db->runQuery("
				SELECT COUNT($col) AS count FROM $table
				WHERE $col=$id;
				");
			return $query;	
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}

	public function getProductList() {
		try {
			return $this->db->runQuery("
				SELECT * FROM products 
				LEFT JOIN categories 
				ON products.Category_id=categories.category_id 
				LEFT JOIN suppliers
				ON products.Supplier_id=suppliers.suppliers_id 
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}

	public function deleteProduct($id) {
		try {
			return $this->db->runQuery("
				DELETE FROM products 
				WHERE product_id={mysql_real_escape_string($id)}
				");
		} catch (Exception $e) {
			$this->closeDB();
			throw $e;
		}
	}


	public function verify($param) {
		return isset($param) ? $param : null;
	}

	public function updateOffer() {
		try {

			$name = self::verify($_POST['name']);	
			$price = self::verify($_POST['price']);
			$quantity = self::verify($_POST['quantity']);
			$product_id = self::verify($_POST['product_id']);
			$descriptionfull = self::verify($_POST['descriptionfull']);
			$descriptionShort = self::verify($_POST['descriptionShort']);
			$location = array(
				self::verify($_POST['addres']),
				array('Lat' => self::verify($_POST['positionLat'])),
				array('Lng' => self::verify($_POST['positionLng']))
				);
			$address = mysql_escape_string(json_encode($location));
			return $this->db->runQuery("
				UPDATE products 
				SET price = '$price', quantity = '$quantity', product_name = '$name', product_address = '$address', full_description = '$descriptionfull', short_description = '$descriptionShort' 
				WHERE product_id = $product_id
				");

		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}

	public function getProduct($id) {
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

	public function add_product() {
		try {	

			$error = "";
			if(($_FILES['fileToUpload']['tmp_name']) != "") {
				$file_tmp = $_FILES['fileToUpload']['tmp_name'];
				$file_name = substr(str_shuffle(md5(time())),0,20);
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);	
				if($check !== false)	
					move_uploaded_file($file_tmp ,"uploads/products/".$file_name.".jpg");
			}

			if(isset($file_name))
				$product_img = $file_name.".jpg";
			else
				$product_img = "noimage.png";
			
			$cor_location = array(
				$_POST['addres'],
				array('Lat' => self::verify($_POST['positionLat'])),
				array('Lng' => self::verify($_POST['positionLng']))
				);

			$user_id  = $_SESSION["user_session"];
			$price = self::verify($_POST['price']);
			$name = self::verify($_POST['product_name']);
			$category = self::verify($_POST['category']);
			$quantity = self::verify($_POST['quantity']);
			$ProductName = self::verify($_POST['product_name']);
			$position = mysql_escape_string(json_encode($cor_location));
			$description_long = self::verify($_POST['description_long']);
			$description_short = self::verify($_POST['description_short']);

			if( $ProductName == "" ) {
				$error = 'Enter Product name';
			} elseif( $quantity == "" ) {
				$error = 'Enter quantity';
			} elseif( $price == "" ) {
				$error = 'Enter price 0.00$ ';
			} elseif( $cor_location == "" ) {
				$error = 'Enter address';
			} elseif( $category == "" ) {
				$error = 'Choose category';
			} else {
				$this->db->runQuery("
					INSERT INTO products (
					product_name, short_description, full_description, photo, category_id, supplier_id, quantity, price, product_address
					) VALUES (
					'$name', '$description_short', '$description_long', '$product_img', '$category', '$user_id', '$quantity', '$price', '$position'
					)
					");
				return true;
			} 
			return $error; 
		}
		catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}	
	}
	public function getTopOffer() {
		try {
			return $this->db->runQuery("	
				SELECT *, count(products_ID) AS orderCount, (
				SELECT COUNT(*) FROM order_detail WHERE products_ID = products.product_ID) AS orders_count 
				FROM order_detail 
				LEFT JOIN products 
				ON products.product_ID = order_detail.products_ID 
				WHERE products.quantity > 0
				GROUP BY products_ID 
				ORDER BY orderCount DESC LIMIT 4
				");	
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}

	public function getTopSellers() {
		try {
			return $this->db->runQuery("	
				SELECT * FROM suppliers 
				INNER JOIN products
				ON products.supplier_id = suppliers.supplier_id
				GROUP BY suppliers.supplier_id
				ORDER BY  suppliers.supplier_id DESC LIMIT 5
				");
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}


	public function select () {
		try {
			return $this->db->runQuery("	
				SELECT * FROM products
				LEFT JOIN categories 
				ON products.Category_id=categories.category_id 
				LEFT JOIN suppliers 
				ON products.Supplier_id=suppliers.supplier_id
				");
			return $query;	
		} catch (Exception $e) {
			$this->closeDb();
			throw $e;
		}
	}
	
}
?>



