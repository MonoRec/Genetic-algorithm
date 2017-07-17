<form method="post" action="routes.php">
	<table id="orders" class="table table-striped table-bordered" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th></th>
				<th>Date</th>
				<th>Address</th>
				<th>Quanity</th>
				<th>Price</th>
				<!-- <th></th> -->
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th></th>
				<th>Date</th>
				<th>Address</th>
				<th>Quanity</th>
				<th>Price</th>
				<!-- <th></th> -->
			</tr>
		</tfoot>
		<tbody>
			<?php 
			$home = array();
			$home = json_decode($orderOnOffer[0]->product_address);
			array_push($home, "0");
			$home = json_encode($home);
			foreach ($orderOnOffer as $order):
				$selectedPlaces = array();
			$address = json_decode($order->delivery_address);
			$selectedPlaces = json_decode($order->delivery_address);
			array_push($selectedPlaces, $order->order_id);
			$selectedPlaces = json_encode($selectedPlaces);
			?>
			<?php if($order->status == 0) { ?> 
			<!-- <tr class="alert"> -->
			<tr>
				<td> <input type="checkbox" name="check_list[]" value='<?php echo $selectedPlaces;?>'> </td>
				<?php } elseif($order->status == 1) {?>
				<!-- <tr class="alert-danger">  -->
				<tr>
				<td><button class="btn-view-fund btn btn-default btn-xs  pull-left" type="button"> <input type="checkbox" name="check_list[]" value='<?php echo $selectedPlaces;?>' disabled=""> </button> </td>
					<?php } else { ?>
					<!-- <tr class="alert-success"> -->
					<tr>
						<td><button class="btn-view-fund btn btn-default btn-xs  pull-left" type="button"> <input type="checkbox" name="check_list[]" value='<?php echo $selectedPlaces;?>' disabled=""> </button></td>
						<?php } ?>
						<td> <?php echo $order->order_date ?></td>
						<td> <?php echo $address[0] ?> <br>
							<?php echo $order->first_name.", "; ?>
							<?php echo $order->last_name; ?> <br>
							<?php echo $order->message; ?>
						</td>
						<td> <?php echo $order->quantity; ?> </td>
						<td> <?php echo $order->quantity * $order->price.".00 $"; ?> </td>
						<!-- <td> -->
						<!-- 	<button id="btn-info" class="btn-view-fund btn btn-default btn-xs" type="button">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button>   -->  
						<!-- </td> -->
					</tr>
					<?php  $selectedPlaces = []; endforeach;
					$arr = json_encode($home); 
					?>
				</tbody>
			</table>
			<input type="hidden" name="home" value='<?php echo $arr; ?>'>
			<input type="submit" name="route-btn" value="Generate route schedule">
		</form>