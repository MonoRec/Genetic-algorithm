<?php

require_once 'models/SearchModel.php';

class SearchController {

	public function __construct() {
		$this->search = new SearchModel();
	}

	public function searchProduct() {
		return $this->search->getSearchResult();	
	}

}