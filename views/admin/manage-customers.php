

  <h5 class="title-bg"> Users-Customers </h5>

  <table id="admin_panel" class="table table-striped table-bordered" cellspacing="0" width="100%">
  	<thead>
  		<tr>

  			<th>First name</th>
  			<th>Second name</th>
  			<th>Reg date</th>
  			<th>phone</th>
  			<th>email</th>
  			<th>act</th>
  		</tr>
  	</thead>
  	<tbody>

  		<?php foreach ($users as $key => $customer): ?>
  			<tr>
  				<td> <?php echo $customer->first_name; ?> </td>
  				<td> <?php echo $customer->last_name; ?> </td>
  				<td> <?php echo $customer->reg_date; ?> </td>
  				<td> <?php echo $customer->phone; ?> </td>
  				<td> <?php echo $customer->email; ?> </td>
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