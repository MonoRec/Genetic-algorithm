<h5 class="title-bg">Popular Sellers</h5>
<ul class="popular-posts">
<?php foreach($query as $user): ?>
	<li>
		<h6><?php echo "<l class='icon-user'></l>".$user->first_name." +371(".$user->phone.")"; ?></h6>
	</li>
<?php endforeach; ?>
</ul>