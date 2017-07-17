		<?php require_once 'controllers/UserController.php'; ?> 
		<?php $users = new UserController(); ?>
	<!--User Login-->
	<h5 class="title-bg">User Login</h5>

	<form class="form-signin" method="post" id="login-form">
		Seller <input style="width: 10px; margin-bottom: 6px;" type="radio" name="flag" value="0" checked> 
		Buyers <input style="width: 10px; margin-bottom: 6px;" type="radio" name="flag" value="1">  
		<?php $users->auth(); ?>
		<div class="input-prepend">
			<span class="add-on"><i class="icon-user"></i></span><input class="span2" name="email" id="prependedInput" size="16" type="text" placeholder="Username">
		</div>
		<div class="input-prepend">
			<span class="add-on"><i class="icon-lock"></i></span><input class="span2" type="password" name="password" id="appendedPrependedInput" size="16" type="text" placeholder="Password">
		</div>
		<button class="btn btn-small btn-inverse" name="btn-login"  type="submit">Login</button>
	</form>