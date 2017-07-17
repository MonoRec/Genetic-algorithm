<?php $totalSale = 0; ?>
		<h2 class="title-bg">My orders</h2>
<!-- <div class="container"> -->
	<div class="row">
		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-container" style="margin-left: 46px;">
						<table class="table table-filter">
							<tbody>
								<?php 			
								if($products !== false) {
									foreach ($products as $product): 
										$arr = json_decode($product->product_address);
									$totalSale += $product->price;
									?>
									<tr data-status="pagado">
										<td>
											<div class="media">
												<a href="#" class="pull-left">
													<img id="product-img" src="/uploads/products/<?php echo $product->photo; ?>" width="70" height="70" alt=" Error 404 image not found" onerror="this.onerror=null;this.src='uploads/products/noimage.png'";>
												</a>
												<div class="media-body">
													<h4 class="title">
														<strong> <?php echo $product->product_name; ?> </strong>

														<?php
														echo "<a href='offers.php?act=offer&id=".$product->product_id."&name=".$product->product_name."'>";
														if($product->ordersCount>0) { ?>
														<span class="pull-right pagado alert-success">
															<strong>Orders: </strong><?php echo $product->ordersCount; ?></span>
															<?php } else { ?>
															<span class="pull-right pagado"><strong>Orders: </strong><?php echo $product->ordersCount; ?></span>
															<?php } ?>
														</a>
													</h4>
													<p class="summary">
														<?php 
														echo $product->category_name;
														echo $arr[0];
														?> 
														<span class="pull-right pagado">
															<strong>
																<?php echo "Price: ".$product->price.".00 $"; ?>
															</strong>
														</span>
														<br>
													</div>
												</div>
											</td>
											<td>
												<a href="offers.php?act=remove&id=<?php echo $product->product_id; ?>">
													<button id="btn-info" class="btn-view-fund btn btn-default btn-xs" type="button">
														<i class="icon-trash" aria-hidden="true"></i>
													</button> 
												</a>
												<button class="btn-view-fund btn btn-default btn-xs" type="button" onclick="toggle(<?php echo $product->product_id; ?>);" style="vertical-align: bottom">
													<i id='<?php echo "cl-op".$product->product_id ?>' class=" icon-chevron-up" aria-hidden="true"> </i>
												</button>		
												<a href='offers.php?act=edit&id=<?php echo $product->product_id; ?>'><button class="btn-view-fund btn btn-default btn-xs" type="button">
													<i class="icon-pencil">
													</i>
												</button></a>
											</td>
										</tr>
										<?php 
										echo "<tr style='display:none;' id='order-info-".$product->product_id."'>"; 
										?>
										
										<td><?php echo $product->full_description."<p>".$product->short_description; ?> </td>
									</tr>
								<?php endforeach; }?>
							</tbody>
						</table>
						<div style="text-align: right;">
							<strong class="alert-success">
								Value of all sales : <?php echo $totalSale.".00 $"; ?>
							</strong>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- </div> -->