<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Product name</th>
			<th>Address</th>
			<th>Price</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $category): $arr = json_decode($category->product_address); ?>
			<tr>	
				<td><article class="clearfix">
				<img style="width: 42px;" src="/uploads/products/<?php echo $category->photo; ?>"  class="align-left"> </a>
					<h4 class="title-bg">					
					<?php echo "<a href='catalog.php?act=show&id=".htmlentities($category->product_id)."' >$category->product_name";?> </a></h4> <?php echo htmlentities($category->short_description); ?>
						<strong><?php echo htmlentities($category->price.".00$"); ?> </strong>
				</article></td>
				<td><?php echo htmlentities($arr[0]); ?></td>
				<td><?php echo $category->price.".00$"; ?></td>
			</tr> 
		<?php endforeach; ?>
	</tbody>
</table>