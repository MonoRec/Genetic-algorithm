<?php foreach ($product as $key => $value):  $address = json_decode($value->product_address); ?>
	<style type="text/css">
		#map {
			width:500px;
			height:300px
		}
	</style>
	<h2 class="title-bg">Edit product </h2>
	<div class="row">
		<div class="span2">
			<?php echo $value->product_name."<br>"; ?>
			<img src="/uploads/products/<?php echo $value->photo; ?>" width="170" height="170">
		</div>
		<div class="span3">
			<div id="map"></div>
		</div>
	</div>
	<form method="POST" action="">
		<div class="row">
			<div class="span4">
				<label for="name">Name:</label>
				<input type="text" name="name" value="<?php echo $value->product_name; ?>"/>
				<label for="name">Descriptions Full:</label>
				<textarea rows="5" cols="50" name="descriptionfull"><?php echo $value->full_description; ?></textarea>
				<label for="name">descriptionShort:</label>
				<textarea rows="5" cols="50" name="descriptionShort"><?php echo $value->short_description; ?></textarea>
			</div>
			<div class="span3">
				<label for="name">Price:</label>
				<input type="text" name="price" value="<?php echo $value->price; ?>"/>
				<label for="name">Quantity:</label>
				<input type="text" name="quantity" value="<?php echo $value->quantity; ?>"/>
				<label for="name">Product Location:</label>
				<input style="width: 171px;" id="searchTextField" class="input-md form-control" placeholder="Enter Addres" name="addres" type="text"  value="<?php echo $address[0]; ?>" size="50">
				<input type="hidden" name="positionLat" id="pLat" value="<?php echo $address[1]->Lat; ?>">
				<input type="hidden" name="positionLng" id="pLng" value="<?php echo $address[2]->Lng; ?>">
				<input type="hidden" name="product_id" value="<?php echo $value->product_id; ?>">
				<br>
				<input type="submit" name="edit-btn" value="Save" />
			</div>
		</div>
	</form>
	<a href="/offers.php?act=show_offer"> Go Back </a>
<?php endforeach; ?>