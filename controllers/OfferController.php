<?php

require_once 'models/OfferModel.php';

class OfferController {

	public function __construct() {
		$this->orderModel = new offerModel();
	}


	// public function searchProduct() {

	// 	$key = $_POST["search"];
	// 		// var_dump($key); die();
	// 	$categories  = $this->orderModel->search($key);
	// 	include 'views/Catalog/catalog-categories.php';

	// }


	public function get_offers_on_order() {

		if(isset($_GET["act"]) && $_GET["act"] == 'add_route') {
			echo '<h2 class="title-bg"> Products </h2>';
			$userProducts = $this->orderModel->getProductsUser();
			if($userProducts) {
				include 'views/Routes/offers.php';
			}
			$orderOnOffer = $this->orderModel->getOrderOffers();
			if($orderOnOffer) {
				
				echo '<h2 class="title-bg">Offers</h2>';
				include "views/Routes/offer-list.php";
			}
		} else {
			return $this->orderModel->getOrderOffers();
		}
	}


	public function getPopularSellers() {
		$query = $this->orderModel->getTopSellers();
		if($query) {
			return $query;
		} else {
			echo "<div class='alert-danger'> THERE ARE NO AVAILABLE PRODUCTS UNDER THIS TOP <div>";
		}
	}

	public function getPopularOffers() {
		$query = $this->orderModel->getTopOffer();
		if($query) {
			return $query;
		} else {
			echo "<div class='alert-danger'> THERE ARE NO AVAILABLE PRODUCTS UNDER THIS TOP <div>";
		}

	}

	// public function showProductList() {
	// 	$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : NULL;
	// 	$products = $this->productsModel->getProductList($orderby);
	// 	include 'view/Products/product-list.php';
	// }



	public function getAllOffers() {
		return $this->orderModel->select();
	}


	public function selectCountOffers($id,$table,$col) {

		$offer = $this->orderModel->get_my_offers_count($id,$table,$col);
		return $offer[0]->count;
	}

	public function redirect($location) {
		
		header('Location: '.$location);
	}


	// public function redirect($location) {
	// 	header('Location: '.$location);
	// }

	// public function click_ada_product(){

	// }

	// public function handleRequest() {

	// 	$act = isset($_GET['act']) ? $_GET['act'] : NULL;
	// 	try {
	// 		if (!$act) {
	// 			$this->show_group_by_category();
	// 		} elseif($act == 'show') {
	// 			$this->showProductDetail($_GET["id"]);
	// 		} elseif($act == 'user_product') {
	// 			$this->getProductByUsers($_SESSION['user_session']);
	// 		} 
	// 		elseif($act == 'showCategory') {
	// 			$this->show_category($_GET["id"]);
	// 		} elseif($act == 'product_add') {
	// 			$this->addProduct($_SESSION["user_session"]);
	// 		} elseif($act == 'edit') {
	// 			$this->editProduct();
	// 		} elseif($act == 'remove') {
	// 			$this->removeProduct();
	// 		} else {
	// 			// $this->showError("Page not found", "Page for operation ".$act." was not found!");
	// 		}

	// 	} catch ( Exception $e ) {
 //            // some unknown Exception got through here, use application error page to display it
	// 		$this->showError("Application error", $e->getMessage());
	// 	}
	// }

	// public function showProductList() {
	// 	$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : NULL;
	// 	$products = $this->productsModel->getProductList($orderby);
	// 	include 'view/Products/product-list.php';
	// }




	public function showUserOffers($id) {
		return $this->orderModel->getProductsUser($id);
	}


	public function editOffer() {

		$user_id = $_GET['id'];

		try {
			if(isset($_POST["edit-btn"])) {
				$query = $this->orderModel->updateOffer($user_id); 
				if($query) {
					echo "ok"; 
				} else {
					echo "error";
				}
			}
		} catch (ValidationException $e) {
			$errors = $e->getErrors();
		}
		return $this->orderModel->getProduct($user_id);
	}


	public function addOffer() {
		if (isset($_POST['form-submitted']) ) {
			try {
				$query = $this->orderModel->add_product();		
				if($query === true) {
					echo "
					<div class='alert-success' style='font-size: 17px;'> 
						<a href=' class='close' data-dismiss='alert'>&times;</a>
						<strong>Successfully Added for sale!</strong> 
					</div>
					";
				} else {
					echo "
					<div class='alert-danger' style='font-size: 17px;'> 
						<a href=' class='close' data-dismiss='alert'>&times;</a>
						<strong>Error!</strong> $query. Please try again.
					</div>
					";
				}
			} catch (ValidationException $e) {
				echo "Error";
			}
		}
	}


	public function verify($param) {

		return isset($param) ? $param : null;
	}

	public function removeProduct() {
		$id = isset($_GET['id']) ? $_GET['id'] : NULL;	
		return $this->orderModel->deleteProduct($id);
	}


	// public function showError($title, $message) {
	// 	include 'view/error.php';
	// }

	// public function verify($param) {
	// 	return isset($param) ? $param : null;
	// }

}