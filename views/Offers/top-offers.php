<h5 class="title-bg">Popular Offers</h5>
<ul class="popular-posts">
<?php foreach($query as $order): ?>
	<li>
		<a href="catalog.php?act=show&id=<?php echo $order->products_id; ?>">
			<img src="uploads/products/<?php echo $order->photo; ?>" class="pull-left gap-right img-thumbnail" onerror="this.onerror=null;this.src='uploads/products/noimage.png'" width="40" >
		</a>
		<h6><?php echo $order->product_name; ?></h6>
		<!-- <em>Posted on 09/01/15</em> -->
	</li>
<?php endforeach; ?>
</ul>