<?php

require_once 'models/CategoryModel.php';


class CategoryController {

	public function __construct() {
		$this->categoryModel = new CategoryModel();
	}
	
	// public function redirect($location) {
	// 	header('Location: '.$location);
	// }

	// public function verify($value) {
	// 	return isset($value) ? $value : null; 
	// }
	// public function handleRequest () {
		
	// 	$act = isset($_GET['act']) ? $_GET['act'] : NULL;
	// 	try {
	// 		if (!$act) {
	// 			return  $this->showCategory();
	// 		} elseif($act == 'remove') { 
	// 			return  $this->removeCategories();
	// 		} elseif($act == 'add') { 
	// 			return  $this->addCategory();
	// 		}
	// 	} catch ( Exception $e ) {
	// 		$this->showError("Application error", $e->getMessage());
	// 	}
	// }

	// public function removeCategories(){
	// 	$id = self::verify($_GET['id']);	
	// 	$this->categoryModel->delete($id);
	// 	self::redirect($_SERVER['HTTP_REFERER']);
	// }

	// public function addCategory() {
	// 	if(isset($_POST["btn-add"])) {
	// 		$name = self::verify($_POST["category_name"]);
	// 		$this->categoryModel->add($name);
	// 		self::redirect($_SERVER['HTTP_REFERER']);
	// 	}
	// 	include 'view/Categories/category-add-form.php';
	// }

	// public function showCategoryList() {	
	// 	$categories = $this->categoryModel->getCategoriesList();
	// 	include 'view/Products/product-store.php';
	// }

	public function showCategories() {	
		return $this->categoryModel->getCategories();
	}

	public function addCategory() {

	}

}

?>