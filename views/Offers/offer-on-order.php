<br><br>
<?php
$routes = array();
$orders_ID = array();
array_push($routes, $orderOnOffer[0]->product_address);
foreach ($orderOnOffer as $order): 
array_push($routes, $order->delivery_address); 
array_push($orders_ID, $order->order_id);
?>
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="table-responsive">
				<table class="table table-sm table-hover">
					<thead class="thead-default">
						<tr class="add-category-row">
							<th style="width: 30px;"></th>
							<?php if($order->status) { ?> 
							<th class="danger" colspan="2">
								<?php } elseif($order->status == 1) {?>
								<th class="warning" colspan="2">
									<?php } else { ?>
									<th class="success" colspan="2">
										<?php }
										echo $order->first_name;
										echo ",".$order->last_name;
										echo " email:  ".$order->email;
										echo " phone:  ".$order->phone;?>
									</th>
									<th style="width: 70px;"></th>
								</th>
							</th>	
						</tr>
					</thead>
					<tr>
						<td>
							<button class="btn-view-fund btn btn-default btn-xs  pull-left" type="button"> <input type="checkbox" name=""> </button>    
						</td>
						<td colspan="2">
							<?php
							echo "<br> description:  ".$order->message;
							echo "<br> Date:  ".$order->order_date;
							echo "<br> Status:  ".$order->status;
							?>
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
					<td>	
					</td>
					<td colspan="3">
						<?php
						echo "<br> quantity: ".$order->quantity;
						echo "<br> description_full: ".$order->full_description;
						echo "<br> description_short: ".$order->short_description;
						echo "<br> price: ".$order->price;
						echo "<br> Category name: ".$order->category_name;
						?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
</div>
<?php 
endforeach;
$arr = json_encode($routes); 
$arrOrders = json_encode($orders_ID); 

?>
<form method="post" action="routes.php">
	<input type="hidden" name="routes-list" value="<?php echo htmlentities($arr); ?>">
	<input type="hidden" name="orderID-list" value="<?php echo htmlentities($arrOrders); ?>">
	<input type="submit" value="Generate route schedule">
</form>
