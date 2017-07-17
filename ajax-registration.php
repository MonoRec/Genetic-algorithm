<?php
require_once 'controllers/UserController.php';
$controller = new UserController();
$status = $controller->UserRegister();
if(isset($status) && !empty($status)) {
		echo $status."<br>";

}
?>