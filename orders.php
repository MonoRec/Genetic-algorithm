<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Orders</title>
	<?php 
	include "includes/head.php";
	include 'classes.php'; 
	?>
</head>
<body>
	<?php 
	include "includes/header.php";
	$offerPanel = new offerPanel();
	$userOffer = new OfferController();
	$catalog = new CatalogController();
	$categories = $catalog->showCategories();
	?>

	<div class="row">
		<?php include 'views/Catalog/catalog-all-categoires.php'; ?>      
		<div class="span8 blog">
			
			<?php 
			$order = new OrderController();
			$action = isset($_GET['act']) ? $_GET['act'] : NULL;
			if($action == 'show_orders') {
				$orders =  $order->showUsersOrders();
				include "views/Orders/customer-orders.php";
			}
			?>

		</div>
		<?php include 'includes/sidebar.php'; ?>
	</div>
	<?php include 'includes/footer.php'; ?>
</body>
</html>