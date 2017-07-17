<div id="div_id_password1" class="form-group required">
	<label for="id_password1" class="control-label col-md-4  requiredField">Category<span class="asteriskField">*</span> </label>
	<div class="controls col-md-8 "> 
		<?php 
		echo "<select name='category' class='input-md form-control'>";
		foreach ($categories as $i => $category) {
			$value= $i+1;
			echo "<option value='$value'> $category->category_name </option>";
		}
		echo "</select>";
		?>
	</div>
</div>