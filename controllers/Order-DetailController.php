<?php

require_once 'models/Order-DetailModel.php';


class OrderDetailController {

	public function __construct() {
		$this->orderDetailModel = new OrderDetailModel();
	}

	// public function get_top_products() {
	// 	$query = $this->orderDetailModel->select();

	// 	if($query) {
	// 		include "views/Orders/top-orders.php";
	// 	} else {
	// 		echo "<div class='alert-danger'> THERE ARE NO AVAILABLE PRODUCTS UNDER THIS TOP <div>";
	// 	}

	// }

	public function getOffers($id) {
		$orderTop = $this->orderDetailModel->getOrderOffers($id);
		include "views/Orders/offer-on-order.php";
	}

	// public function getOffers($id) {
	// 	$orderTop = $this->orderDetailModel->getOrderOffers($id);
	// 	include "view/OrderDetails/supplier-orders.php";
	// }

}
?>