<?php

require_once 'models/ProfileModel.php';

class ProfileController {

	public function __construct() {
		$this->profileModel = new ProfileModel();
	}
	
	public function editUsers() {	
		$query = $this->profileModel->update();	
		if($query === true) {
			echo "
			<div class='alert-success'> 
				<h4> Successfuly edit </h4> 
			</div>
			";
		} 
		if($query === false) {
			echo "
			<div class='alert-danger'> 
				<h4> Error! </h4>
			</div>

			";
		}
	}

	public function editPassword () {
		$query = $this->profileModel->resetPassword();
		if($query === true) {
			echo "
			<div class='alert-success'> 
				<h4> Password changed successfully </h4> 
			</div>
			";
		} 
		if($query === false) {
			echo "
			<div class='alert-danger'>
				<h4>Error! </h4> 
			</div>

			";
		}
	}

	public function showUserDetails() {
		return $this->profileModel->getUsetDetails();
	}

}
?>