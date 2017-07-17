<?php 
session_start();
include 'controllers/RoutesController.php';
$routes = new RoutesController();
$routes->addRoute();
?>