<?php foreach ($userDetails as $supplier): endforeach;?>
	<div class="container">    
		<div id="signupbox" style=" margin-top:50px" class="mainbox   col-md-8">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Profile Form</div>
				</div>
				<div class="panel-body" >	
					<form method="post">
						<div id="div_id_username" class="form-group required">
							<label for="id_username" class="control-label col-md-4  requiredField"> Name <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="input-md  textinput textInput form-control" id="name" maxlength="30" value="<?php  if($supplier->first_name) echo $supplier->first_name;?>" name="name" placeholder="Choose your name" style="margin-bottom: 10px" type="text" />
							</div>
						</div>
						<div id="div_id_username" class="form-group required">
							<label for="id_username" class="control-label col-md-4  requiredField"> Surname <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="input-md  textinput textInput form-control" id="id_username" value="<?php if($supplier->last_name) echo $supplier->last_name;?>" maxlength="30" name="surname" placeholder="Choose your surname" style="margin-bottom: 10px" type="text" />
							</div>
						</div>
						<div id="div_id_username" class="form-group required">
							<label for="id_username" class="control-label col-md-4  requiredField"> Username </label>
							<div class="controls col-md-8 ">
								<input class="input-md  textinput textInput form-control" id="id_username" value="<?php if($supplier->user_name) echo $supplier->user_name;?>" maxlength="30" name="username" placeholder="Choose your username" style="margin-bottom: 10px" type="text" />
							</div>
						</div>
						<div id="div_id_email" class="form-group required">
							<label for="id_email" class="control-label col-md-4"> E-mail<span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="input-md form-control" id="id_email" name="mail" value="<?php if($supplier->email) echo $supplier->email;?>" placeholder="Your current email address" style="margin-bottom: 10px" />
							</div>     
						</div>

						<div id="div_id_number" class="form-group required">
							<label for="id_number" class="control-label col-md-4  requiredField"> Mobile Phone</label>
							<div class="controls col-md-8 ">
								<input class="input-md textinput textInput form-control" id="id_number" value="<?php if($supplier->phone)  echo $supplier->phone;?>" name="phone" placeholder="Provide your number" style="margin-bottom: 10px" type="text" />
							</div> 
						</div> 
						
						<div class="form-group">
							<div class="controls col-md-offset-4 col-md-8 ">
								<div id="div_id_terms" class="checkbox required">
									<label for="id_terms" class=" requiredField">
										<input class="input-ms checkboxinput" id="id_terms" name="terms" style="margin-bottom: 10px" type="checkbox" required />
										Agree with the terms and conditions
									</label>
								</div> 

							</div>
						</div> 
						<div class="form-group"> 
							<div class="aab controls col-md-4 "></div>
							<div class="controls col-md-8 ">
								<input type="submit" name="btn-update" value="Save" class="btn btn-primary btn btn-info" id="submit-id-signup" />

							</div>
						</div> 
						<input type="hidden" name="suppliers-id" value ="<?php echo $supplier->customer_id; ?>">
					</form>
				</div>
			</div>
		</div> 
	</div>
