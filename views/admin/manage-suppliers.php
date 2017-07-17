  <h5 class="title-bg"> Users-Supplers </h5>

  <table id="admin_panel" class="table table-striped table-bordered" cellspacing="0" width="100%">
  	<thead>
  		<tr>

  			<th>First name</th>
  			<th>Second name</th>
  			<th>Reg date</th>
  			<th>phone</th>
  			<th>email</th>
  			<th>Company</th>
  			<th>act</th>
  		</tr>
  	</thead>
  	<tbody>
  		<?php foreach ($users as $key => $suppliers): ?>
  			<tr>	
  				<td><?php echo $suppliers->first_name ?></td>
  				<td><?php echo $suppliers->second_name ?></td>
  				<td><?php echo $suppliers->registration_date ?></td>
  				<td><?php echo $suppliers->phone ?></td>
  				<td><?php echo $suppliers->email ?></td>
  				<td>
  					<?php if($suppliers->company_id != 0)  { ?>

  					<?php echo "<scrong>".$suppliers->company_name."</strong>"; ?>
  					<?php echo $suppliers->company_phone; ?>
  					<?php echo $suppliers->short_company_description; ?>
  					<?php } else { ?>
  					NoNe
  					<?php } ?>
  				</td>
  				<td>
  					<a href="admin.php?table=suppliers&act=edit&id=<?php echo $suppliers->supplier_id; ?>"><i class="icon-pencil alert-success"></i>
  					</a>
  					<a href="admin.php?table=suppliers&act=remove&id=<?php echo $suppliers->supplier_id; ?>"> <i class="icon-remove alert-danger"></i> 
  					</a>
  				</td>
  			</tr> 
  		<?php endforeach; ?>
  	</tbody>
  </table>
