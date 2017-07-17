<?php

class MainPage {

	public function click_catalog() {
		return '<a href="catalog.php">Catalog</a>';
	}

	public function click_login() {
		return '<a href="login.php"> Login </a>';
	}
	public function click_registration() {
		return '<a href="registration.php"> Resgitration </a>';
	}
	public function click_logot() {
		return "<a href='logout.php'> Logout </a>";
	}

}