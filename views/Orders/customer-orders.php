<?php $count = 0; ?>
<?php $totalSale = 0; ?>
		<h2 class="title-bg">My orders</h2>
<!-- <div class="container"> -->
	<div class="row">
		<div class="col-md-8">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
					<tbody>
						<?php 
						if(isset($orders) && $orders != null) 
							foreach ($orders as $order): 
								$count++; 
							?>
							<tr>
								<td>
									<button class="btn-view-fund btn btn-default btn-xs  pull-left" type="button">
										<input type="checkbox" name="">
									</button>    
								</td>
								<td colspan="2">
									<?php
									echo "<strong>".$order->product_name."</strong>";
									echo $order->full_description;
									echo $order->short_description."<br>";		
									if($order->status == 0) { ?>
									<div class="alert alert-warning" role="alert"><strong> Orrder status: </strong> In progress </div>
									<?php } else if($order->status == 1) { ?> 
									<div class="alert alert-success" role="alert"><strong> Orrder status: </strong> Complete </div>
									<?php } else { ?> 
									<div class="alert alert-danger" role="alert"><strong> Orrder status: </strong> Something went wrong </div>			
									<?php } ?>
									<div style="text-align: right;"> <?php echo "<strong>Date: </strong>".$order->order_date; echo "<strong> Delivery: </strong>".$order->shippers_name."<br>";?>
									</div>
								</td>
								<td style="text-align: right;">
									<button class="btn-view-fund btn btn-default btn-xs" type="button" onclick="toggle(<?php echo $order->order_id ?>);">
										<span id='<?php echo "cl-op".$order->order_id ?>' class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
									</button> 
									<button id="btn-info" class="btn-view-fund btn btn-default btn-xs" type="button">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</button>     
								</td>
							</tr>
							<?php echo "<tr style='display:none'id='order-info-".$order->order_id."'>"; ?>
							<td colspan="3">
								<div class="panel panel-success">
									<div class="panel-body panel panel-success">
										<div id="row">
											<img id="offer-product-list" width="170" height="170" src="uploads/products/<?php echo $order->photo; ?>" class="pull-left gap-right img-thumbnail" onerror="this.onerror=null;this.src='uploads/products/noimage.png'" />
										</div>
										<?php 
										echo "<strong> Date: </strong>".$order->order_date."<br>";
										echo "<strong> Comment: </strong>".$order->message."<br>";
										echo "<strong> Shipper: </strong>".$order->shippers_name."<br>";	 

										echo "<strong> Price </strong>".$order->price.".00 $";
										echo "<strong> Count: </strong>".$order->quantity;
										?>
									</div>
									<div class="panel-body">
										<strong> Seller: </strong>
										<?php 
										echo $order->first_name;
										echo ",".$order->second_name;
										echo ", <strong>".$order->company_id."</strong>";
										echo "Poke netu"; 
										?> 
									</div>
									<div class="panel-body">
										<strong> Contacts: </strong>
										<?php 
										echo "(Mob)".$order->phone;				
										echo "(Mail)".$order->email;
										?>
									</div>
								</div>
							</td>
							<td style="text-align: right;">
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<!-- <form method="POST" action="routes.php">
				Generate schedule of delivery				
				<input type="submit" value="Go">			
			</form> -->
		</div>
	</div>

</div>
<script type="text/javascript">
	
	var toggle = function($id) {
		var myspan= document.getElementById('cl-op' + $id);
		var mydiv = document.getElementById('order-info-' + $id);

		if (mydiv.style.display === '' || mydiv.style.display === '') {
			mydiv.style.display = 'none';
			myspan.className = 'icon-chevron-down';
		} else {
			mydiv.style.display = '';
			myspan.className = 'icon-chevron-up';
		}
	}

</script>