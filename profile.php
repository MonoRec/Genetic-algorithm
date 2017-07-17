<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Profile</title>
	<?php 
	include "includes/head.php";
	include 'classes.php'; 
	?>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<?php 
	$offerPanel = new offerPanel();
	$userOffer = new OfferController();
	$catalog = new CatalogController();
	$categories = $catalog->showCategories();
	?>

	<div class="row">
		
		<?php include 'views/Catalog/catalog-all-categoires.php'; ?>      
		
		<div class="span8 blog">
			<h2 class="title-bg">Profile</h2>
			<?php
			$users = new ProfileController();
			$userDetails = $users->showUserDetails();
			$users->editUsers();
			$users->editPassword();
			if($_SESSION["user_type"] == 1) { 
				include 'views/Users/user-info-customer.php'; 
			}
			if($_SESSION["user_type"] == 0) {
				include 'views/Users/user-info-supplier.php'; 
			}

			?>
		</div>
		<?php include 'includes/sidebar.php'; ?>
	</div>
</div>



<?php include 'includes/footer.php'; ?>
</body>
</html>