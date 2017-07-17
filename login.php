<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
	<?php include 'includes/header.php'; ?>
</head>
<body>

	<?php include 'includes/nav-bar.php';  ?>
	<?php require_once 'controllers/UserController.php'; ?> 
	<?php 
	$users = new UserController();
	
	require_once 'controllers/OrderController.php';
	require_once 'controllers/Order-DetailController.php';
	// require_once 'controllers/ProductController.php';
	// require_once 'controller/CategoryController.php';
	// require_once 'classes/MainPage.php';
	?>
	<div class="container">
		<div class="row">
			<div class='col-md-8'>
				<h1 class="page-header"><br><br>
					Log In
				</h1>
				<form class="form-signin" method="post" id="login-form">
					<input type="radio" name="flag" value="0" checked> Seller
					<input type="radio" name="flag" value="1"> Buyers 
					<?php $users->auth(); ?>
					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="E mail" required />
						<span id="check-e"></span>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="password" placeholder="Your Password" />
					</div>
					<hr/>
					<div class="form-group">
						<button type="submit" name="btn-login" class="btn btn-default">
							<i class="glyphicon glyphicon-log-in"></i> &nbsp; SIGN IN
						</button>
					</div>
				</form>	
			</div>
			<?php include 'includes/sidebar.php'; ?>
		</div>
		<?php include 'includes/footer.php'; ?>
	</div>
</body>
</html>