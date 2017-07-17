<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Sellers </title>
	<?php include 'includes/header.php'; ?>
</head>
<body>
	<?php include 'includes/nav-bar.php';  ?>

	<?php
	
	require_once 'controllers/OrderController.php';
	require_once 'controllers/Order-DetailController.php';
	// require_once 'controller/CategoryController.php';
	// require_once 'classes/MainPage.php';

	?>
	<div class="container">
		<div class="row">
			<div class='col-md-8'>
			Customers
		
		</div>


		<?php include 'includes/sidebar.php'; ?>

	</div>
	<?php include 'includes/footer.php'; ?>
</div>
</body>
</html>