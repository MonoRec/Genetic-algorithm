<?php 


class AdminPanel {
	
	public function clickOffers() {
		return '<a href="admin.php?table=offers"> Products </a>';
	}

	public function clickCustomers() {
		return '<a href="admin.php?table=customers"> Customers </a>';
	}	

	public function clickSuppliers() {
		return '<a href="admin.php?table=suppliers"> Suppliers </a>';
	}

	public function clickCategories() {
		return '<a href="admin.php?table=categories"> Categories </a>';
	}

}