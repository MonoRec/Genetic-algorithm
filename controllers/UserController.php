<?php 

require_once 'models/UserModel.php';

class UserController {

	public function __construct() {
		$this->userModel = new UserModel();
	}

	public function auth() {
		if(isset($_POST['btn-login'])) {
			if($this->userModel->checkLogin()) {
				header("Location: /"); 		
			} else {
				echo '
				<div class="alert alert-danger fade in"> 
					<a href="" class="close" data-dismiss="alert">&times;</a>
					<strong>Error!</strong> Incorrect email address or password. Please try again.
				</div>';
			}
		}
	}

	public function getUsersList() {
		return $this->userModel->select();
	}

	public function updateUser() {
		return $this->userModel->update();
	}

	public function removeUser() {
		return $this->userModel->remove();
	}

	public function getUser() {
		return $this->userModel->selectById();
	}

	public function UserRegister(){  
		return $this->userModel->addUser();
	}  


	public function is_loggedin() {
		if(isset($_SESSION['user_session'])) {
			return true;
		}
	}

	public function doLogout() {
		session_start();
		session_destroy();
		header("Location: /");
		return false;
	}

}