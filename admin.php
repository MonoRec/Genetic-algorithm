<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Admin Panel </title>
	<?php include "includes/head.php"; ?>
	<?php include 'classes.php'; ?>
</head>
<body>

	<?php include "includes/header.php"; ?>
	<div class="row">
		<div class="span12">
			<?php
			$user = new UserController();
			$offer = new OfferController ();
			$category = new CategoryController();


			$table = isset($_GET['table']) ? $_GET['table'] : NULL;
			$action = isset($_GET['act']) ? $_GET['act'] : NULL;

			if($table == 'customers') {
				$users = $user->getUsersList();
				include 'views/admin/manage-customers.php';
				if($action == 'remove') {
					$user->removeUser();
				} else if($action == 'edit') {
					$userDetails = $user->getUser();
					include 'views/Users/user-info-customer.php'; 
					$user->updateUser();

				}
			} 
			if($table == 'suppliers') {
				if($action == 'remove') {
					$user->removeUser();
				} else if($action == 'edit') {
					$userDetails = $user->getUser();
					include 'views/Users/user-info-supplier.php'; 
					$user->updateUser();
				}
				$users = $user->getUsersList();
				include 'views/admin/manage-suppliers.php';
			} 


			if($table == 'offers') {
				$offers = $offer->getAllOffers();

				include 'views/admin/manage-offers.php';
			} 


			if($table == 'categories') {
				include 'views/admin/manage-categories.php';
			} 







	// elseif($table == 'order') {	

			// 	include 'views/admin/offers-list.php';
			// 	$act = isset($_GET['act']) ? $_GET['act'] : NULL;
			// 	if($act == 'add')   
			// 		$this->productController->addProduct($_SESSION['user_session']);
			// 	if($act == 'remove')   
			// 		$this->productController->removeProduct();
			// 	if($act == 'edit')
			// 		$this->productController->editProduct();
			// 	return $this->productController->show_category("");

			// } elseif($table == 'offer') {
			// 	include 'views/admin/manage-offers.php';
			// }  elseif($table == 'category') {
			// 	include 'views/admin/manage-categories.php';
			// } else { } 
			?>
		</div>
	</div>
	<?php include 'includes/footer.php'; ?>
</div>
</body>
<script type="text/javascript">
	



	$('#admin_panel').DataTable( {
		"lengthChange": false,	
		"sDom": '<"top"flp>rt<"bottom"i><"clear">',

	});
	
	$( "#admin_panel_paginate" ).addClass( "pagination" );
	$( "#admin_panel_paginate" ).css( "text-align","center" );
	$( "#admin_panel_filter" ).css( "display","none" );	


	// $('#users').DataTable( {
	// 	"lengthChange": false,	
	// 	"sDom": '<"top"flp>rt<"bottom"i><"clear">',

	// });

	// $( "users_paginate" ).addClass( "pagination" );
	// $( "users_paginate" ).css( "text-align","center" );
	// $( "users_filter" ).css( "display","none" );



</script>
</html>