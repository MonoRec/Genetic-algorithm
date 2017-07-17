<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<?php include 'header.php' ?>
</head>
<body>
	<?php

	session_start();
	require_once 'controller/SuppliersController.php';
	require_once 'controller/CategoryController.php';
	require_once 'controller/ProductsController.php';

	$controller = new SuppliersController();
	include 'nav-bar.php';
	?>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<!-- Blog Entries Column -->
			<div class="col-md-12">
				<?php
				$controller = new ProductsController();
				$controller->handleRequest();

				?>
			</div>
		</div>
	</div>
</body>
</html>


