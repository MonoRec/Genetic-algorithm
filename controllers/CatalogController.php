<?php

require_once 'models/CatalogModel.php';

class CatalogController {

	public function __construct() {
		$this->orderModel = new CatalogModel();
	}

	public function showCategories() {
		return $this->orderModel->getCategories();
	}

	public function showOffersInCategory() {
		
		return $this->orderModel->getOffersByCategory();
	}

	public function showProductDetail() {	
		return $this->orderModel->getOfferDetail();	
	}

}