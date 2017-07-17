<?php

require_once 'models/OrderModel.php';

class OrderController {

	public function __construct() {
		$this->orderModel = new OrderModel();
	}

	public function updateOrders($ordersList) {
		$arr = explode(",", $ordersList);
		foreach ($arr as $key => $value) {
			$this->orderModel->update_status($value);
		}
	}

	public function selectCountOrders($id,$table,$col) {
		$orders = $this->orderModel->get_my_orders_count($id, $table,$col);
		return $orders[0]->count;
	}

	public function showUsersOrders() {
		return $this->orderModel->getOrdersList();	
	}


	public function add_new_order() {
		$query = $this->orderModel->add_order();
		if($query === true) {
			echo '
			<div class="alert alert-success" role="alert">
				<strong> Well done! </strong> order have been successfully received.
			</div>';
		} else {
			echo '
			<div class="alert alert-danger" role="alert">
				<strong>'.$query.'!</strong> Try again.
			</div>';
		}
	}
}