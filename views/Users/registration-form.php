<h2 class="title-bg">Registration form</h2>
<!-- <div class="comment-form-container"> -->
<!-- <div class="comment-form-container"> -->
<form enctype="multipart/form-data" action="__URL__" method="POST" id="reg-from" class="form-horizontal">
	<div class="comment-form-container">
		<!-- <h2 class="title-bg">Registration form</h2> -->

		<label for="firstName" class="col-sm-5 control-label">First Name</label>
		
		<input type="text" name="firstName" placeholder="Full Name" class="form-control" autofocus>		


		<div class="form-group">
			<label for="firstName" class="col-sm-5 control-label">Last Name</label>
			<div class="col-sm-5">
				<input type="text" name="secondName" placeholder="Full Name" class="form-control" autofocus>
			</div>
		</div>
		<!-- <div class="form-group"> -->
		<!-- <label for="firstName" class="col-sm-5 control-label">User name</label> -->
		<!-- <div class="col-sm-5"> -->
		<input type="hidden" name="userName" placeholder="Full Name" value ="dasdsa"class="form-control" autofocus>
		<!-- </div> -->
		<!-- </div> -->
		<div class="form-group">
			<label for="email" class="col-sm-5 control-label">Email</label>
			<div class="col-sm-5">
				<input type="email" name="email" placeholder="Email" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-5 control-label">Password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" name="password" placeholder="Password" id="password"/>
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-5 control-label">Re password</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" placeholder="Re:Password" name="cfmPassword" id="cfmPassword" />
			</div>
		</div>
		<div class="form-group">
			<label for="password" class="col-sm-5 control-label">Phone</label>
			<div class="col-sm-5">
				<input type="text" name="phone" placeholder="Phone" class="form-control">
			</div>
		</div>
		<div class="form-group">
			<label for="country" class="col-sm-5 control-label">Address</label>
			<div class="col-sm-5">
				<input type="text" id="searchTextField" name="address" class="form-control" placeholder="Address">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-5">Type</label>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-4">
						<label class="radio-inline">
							<input type="radio" class="radio-btn" name="userType" value="1" checked>Buyer
							<input type="radio" class="radio-btn" name="userType" value="0">Seller
						</label>
					</div>
				</div>
			</div>
		</div>
		<div id="buyer-block" style="display:none;">
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Company Name</label>
				<div class="col-sm-5">
					<input type="text" name="companyName" placeholder="Name" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Address</label>
				<div class="col-sm-5">
					<input type="text" name="companyAddress" placeholder="Address" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Phone</label>
				<div class="col-sm-5">
					<input type="text" name="companyPhone" placeholder="Phone" class="form-control">
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Fax</label>
				<div class="col-sm-5">
					<input type="text" name="companyFax" placeholder="Fax" class="form-control">
				</div>
			</div>	
			<div class="form-group">
				<label for="file" class="col-sm-5 control-label">Photo</label>
				<div class="col-sm-5">

					<input name="userfile" type="file" />
				</div>
			</div>
			<div class="form-group">
				<label for="password" class="col-sm-5 control-label">Description</label>
				<div class="col-sm-5">
					<input type="text" name="companyDescription" placeholder="Description" class="form-control">
				</div>
			</div>
		</div>

		<div class="form-group">
			<label for="country" class="col-sm-5 control-label"></label>
						<div class="col-sm-5">
			<div class="checkbox">
				<input type="checkbox" name="term-check"> I accept <a href="/">terms</a>
			</div>
			</div>
		</div>


	</div>


	<div id="error" style="color:red; font-size: 15px;"></div>

	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-5">
			<input type="hidden" id="positionLat" name="positionLat">
			<input type="hidden" id="positionLng" name="positionLng">
			<div id="error"></div>
			<div class="span7" > 
			<button type="submit" class="btn btn-primary btn-block">Register</button>
			</div>
		</div>
	</div>
</div>
</form>

