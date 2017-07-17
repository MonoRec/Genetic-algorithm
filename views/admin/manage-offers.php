  <h5 class="title-bg"> Products </h5>
  


  <table id="admin_panel" class="table table-striped table-bordered" cellspacing="0" width="100%">
  	<thead>
  		<tr>

  			<th></th>
  			<th>Products name</th>
  			<th>Products name</th>
  			<th>Products name</th>
  			<th>Products name</th>
  			<th>Products name</th>
  			<th>Products name</th>
  			<th>Act</th>
  			
  		</tr>
  	</thead>
  	<tbody>

  		<?php foreach ($offers as $key => $offer): ?>
  			<tr>
  				<td> 

  					<img src="../uploads/products/<?php echo $offer->photo; ?>" width="40" height="40">
  				</td>
  				<td> <?php echo $offer->product_name; ?> </td>
  				<td> <?php echo $offer->product_name; ?> </td>
  				<td> <?php echo $offer->product_name; ?> </td>
  				<td> <?php echo $offer->product_name; ?> </td>
  				<td> <?php echo $offer->product_name; ?> </td>
  				<td> <?php echo $offer->product_name; ?> </td>

  				<td>
  					<a href="admin.php?table=customers&act=edit&id=<?php echo $customer->customer_id; ?>"><i class="icon-pencil alert-success"></i>
  					</a>
  					<a href="admin.php?table=customers&act=remove&id=<?php echo $customer->customer_id; ?>"> <i class="icon-remove alert-danger"></i> 
  					</a>
  				</td>
  			</tr>
  		<?php endforeach ?>	
  	</tbody>
  </table>
