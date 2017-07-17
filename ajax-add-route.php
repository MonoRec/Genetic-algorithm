<?php
include 'classes.php';
$controller = new RoutesController();
$controller->addRoute($_POST["addresses"]);
$controller = new OrderController();
$controller->updateOrders($_POST["orders"]);
?>
