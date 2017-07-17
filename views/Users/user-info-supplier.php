<?php foreach ($userDetails as $supplier): endforeach; ?>

	<div class="container">    
		<div id="signupbox" style=" margin-top:50px" class="mainbox   col-md-8">
			<div class="panel panel-info">
				<div class="panel-body" >	
					<form method="post" class="form-horizontal">


						<div id="div_id_username" class="form-group required">
							<label for="id_username" class="control-label col-md-4  requiredField"> Name <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="" id="name" maxlength="30" value="<?php  if($supplier->first_name) echo $supplier->first_name;?>" name="name" placeholder="Choose your name" style="margin-bottom: 10px" type="text" />
							</div>
						</div>

						<div id="div_id_username" class="form-group required">
							<label for="id_username" class="control-label col-md-4  requiredField"> Surname <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="" id="id_username" value="<?php if($supplier->second_name) echo $supplier->second_name;?>" maxlength="30" name="surname" placeholder="Choose your surname" style="margin-bottom: 10px" type="text" />
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
						<div id="div_id_gender" class="form-group required">
							<label for="id_gender"  class="control-label col-md-4  requiredField"> Company </label>
							<div class="controls col-md-8 "  style="margin-bottom: 10px">
								<input type="radio" name="comp2" id="id_1" value="M"  style="margin-bottom: 10px" onchange="radioCheck('id_1')"> No </label>
								<input type="radio" name="comp2" id="id_2" value="F"  style="margin-bottom: 10px" onchange="radioCheck('id_2')"> Yes </label>
							</div>
						</div>
						<!-- <div id="cmp-info" style="display:none;"> -->
						
						<?php if( $supplier->company_name || $supplier->description || $supplier->company_location || $supplier->company_phone || $supplier->fax ) { ?>
						<div id="cmp-info" style="">
							<?php } else { ?>
							<div id="cmp-info" style="display:none;">
								<?php } ?>

								<div id="div_id_company" class="form-group required">
									<label for="id_company" class="control-label col-md-4  requiredField"> Company name</label>
									<div class="controls col-md-8 "> 
										<input class="input-md textinput textInput form-control" id="id_company" value="<?php if($supplier->company_name) echo $supplier->company_name;?>" name="company-name" placeholder="Your company name" style="margin-bottom: 10px" type="text" />
									</div>
								</div> 

								<div id="div_id_company" class="form-group required"> 
									<label for="id_company" class="control-label col-md-4  requiredField"> Description</label>
									<div class="controls col-md-8 "> 
										<input class="input-md textinput textInput form-control" id="id_company" value="<?php if($supplier->short_company_description) echo $supplier->short_company_description;?>" name="company-description" placeholder="Your company info" style="margin-bottom: 10px" type="text" />
									</div>
								</div> 

								<div id="div_id_company" class="form-group required"> 
									<label for="id_company" class="control-label col-md-4  requiredField"> Location</label>
									<div class="controls col-md-8 "> 
										<input class="input-md textinput textInput form-control" id="id_company" value="<?php if($supplier->company_address) echo $supplier->company_address;?>" name="company-location" placeholder="Company address" style="margin-bottom: 10px" type="text" />
									</div>
								</div> 

								<div id="div_id_company" class="form-group required"> 
									<label for="id_company" class="control-label col-md-4  requiredField"> Phone</label>
									<div class="controls col-md-8 "> 
										<input class="input-md textinput textInput form-control" id="id_company" value="<?php if($supplier->company_phone) echo $supplier->company_phone;?>" name="company-phone" placeholder="Work phone" style="margin-bottom: 10px" type="text" />
									</div>
								</div>

								<div id="div_id_company" class="form-group required"> 
									<label for="id_company" class="control-label col-md-4  requiredField"> Fax</label>
									<div class="controls col-md-8 "> 
										<input class="input-md textinput textInput form-control" id="id_company" value="<?php if($supplier->fax) echo $supplier->fax;?>" name="company-fax" placeholder="Fax" style="margin-bottom: 10px" type="text" />
									</div>
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
									<input type="submit" style="width: 344px" name="btn-update" value="Save" class="btn btn-primary btn btn-info" id="submit-id-signup" />

								</div>
							</div> 
							<input type="hidden" name="suppliers-id" value ="<?php echo $supplier->suppliers_id; ?>">
							<input type="hidden" name="company-id" value ="<?php echo $supplier->company_id; ?>">
						</form>


						<form method="post" class="form-horizontal">
							<label class="control-label col-md-4"> Password <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="" id="name" maxlength="30" name="password" placeholder="Passworwd" style="margin-bottom: 10px" type="text" />
							</div><label class="control-label col-md-4"> New password <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="" id="name" maxlength="30" name="newPassword" placeholder="New password" style="margin-bottom: 10px" type="text" />
							</div><label class="control-label col-md-4"> Cnf password <span class="asteriskField">*</span> </label>
							<div class="controls col-md-8 ">
								<input class="" id="name" maxlength="30" name="cnfPassword" placeholder="Cnf password" style="margin-bottom: 10px" type="text" />
							</div>

							<div class="controls col-md-8 ">
								<input type="submit" style=" width: 344px" name="btn-password" value="Save" class="btn btn-primary btn btn-info" id="submit-id-signup" />
							</div>
						</form>
					</div>
				</div>
			</div> 
		</div>


		<script type="text/javascript">

			var check_radio_1 = document.getElementById('id_1');
			var check_radio_2 = document.getElementById('id_2');

			window.onload = function(){
				if (document.getElementById('cmp-info').style.display === 'none')
					check_radio_1.checked = true;
				else
					check_radio_2.checked = true;
			};

			function radioCheck($id) {
				var div = document.getElementById('cmp-info');
				if (document.getElementById($id).id === 'id_1') {				
					check_radio_1.checked = true;
					check_radio_2.checked = false;
					div.style.display = 'none';
				} else {	
					check_radio_1.checked = false;
					check_radio_2.checked = true;
					div.style.display = '';
				}
			}
		</script>

