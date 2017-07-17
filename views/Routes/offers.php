<table id="offers" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Name</th>
			<th>Orders</th>
			<th>Product Address</th>
			<th>Date</th>
			<th>Price</th>
			<th>Quantity</th>
			<th> - </th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Name</th>
			<th>Orders</th>
			<th>Product Address</th>
			<th>Date</th>
			<th>Price</th>
			<th>Quantity</th>
			<th> - </th>
		</tr>
	</tfoot>
	<tbody>
		<?php foreach ($userProducts as $key => $value)  { 
			$add = json_decode($value->product_address); ?>
			<tr>
				<td><?php echo $value->product_name; ?></td>
				<td><?php echo $value->ordersCount; ?></td>
				<td><?php echo $add[0]; ?></td>
				<td><?php echo $value->date; ?></td>
				<td><?php echo $value->price.".00$"; ?></td>
				<td><?php echo $value->quantity; ?></td>
				<td>
					<a href="/routes.php?act=add_route&id=<?php echo $value->product_id; ?>">Show orders</a>
					<div id="result"></div>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>