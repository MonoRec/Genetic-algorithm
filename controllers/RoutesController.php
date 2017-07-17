<?php

require_once 'models/RoutesModel.php';

class RoutesController {

	public function __construct() {
		$this->routeModel = new RoutesModel();
	}	

	public function addRoute() {
		return $this->routeModel->add();

	}	

	public function showUsersRoutes() {
		return $this->routeModel->getRoutesById();

	}
}	

?>