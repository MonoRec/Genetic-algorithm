<h5 class="title-bg">My routes</h5>
<ul class="post">
	<?php foreach ($route as $key => $value): ?>
		<li><a href="routes.php?act=show_routes&id=<?php echo $value->route_id; ?> "><?php echo $key." - ".$value->date; ?></a></li>
	<?php endforeach ?>
</ul>
<?php 
if(isset($_GET["id"])) {
	foreach ($route as $key => $value) {
		if($_GET["id"] == $value->route_id) {
			$arr = json_decode($value->delivery_places);
		$url = "https://www.google.com/maps/embed/v1/directions?key=AIzaSyCsJ_XkaVcu2NvTkaDbkN5U_2yo65nWSxQ&origin=".$arr[0]."&destination=".$arr[0]."&waypoints=".implode('|',$arr);
				echo "<iframe width='100%' height='500' frameborder='0'src='$url' allowfullscreen> </iframe>";
		}
	}
}
?>