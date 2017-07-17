<?php
require_once 'models/ShippersModel.php';


class ShippersController {

	public function __construct() {
		$this->shippersModel = new ShippersModel();
	}

	public function showShippersList(){
		return $this->shippersModel->getShippersList();
	}

	// public function addShipper() {
		
	// }	
	// public function editShipper() {
		
	// }	
	// public function removeShipper() {

	// }

}	
?>