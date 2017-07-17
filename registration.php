<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Registraion</title>
	<?php 
	include "includes/head.php";
	include 'classes.php'; 
	?>
	<style type="text/css">
		/*#map {
			width:700px;
			height:400px
		}*/
	</style>
</head>
<body>

	<?php

	include "includes/header.php";	 
	$offerPanel = new offerPanel();
	$userOffer = new OfferController();
	$catalog = new CatalogController();
	$categories = $catalog->showCategories();
	?>
	<div class="row">
		<?php include 'views/Catalog/catalog-all-categoires.php'; ?>      
		<div class="span8 blog">
			<?php include 'views/Users/registration-form.php'; ?>
			<!-- </div> -->
			<div id="map"> </div>
		<!-- </div> -->
		<?php include 'includes/sidebar.php'; ?>
	</div>
</div>

</body>
<script>


	$(".radio-btn").click(function(){		

		if($('input[name=userType]').filter(':checked').val() == 1) 
			$("#buyer-block").hide();
		else 
			$("#buyer-block").show();
	});

	$("#reg-from").submit(function(e) {
		var url = "ajax-registration.php";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#reg-from").serialize(),
			success: function(data) {
				$("#error").html(data);
			},
			error: function(data) {
				$("#error").html(data);
			}
		});
		e.preventDefault();
	});	
</script>
<script>
	function initAutocomplete() {
		var map = new google.maps.Map(document.getElementById('map'), {});
		var input = document.getElementById('searchTextField');
		var searchBox = new google.maps.places.SearchBox(input);
		var markers = [];
		searchBox.addListener('places_changed', function() {
			var places = searchBox.getPlaces();
			places.forEach(function(place) {
				markers.push(new google.maps.Marker({
					map: map,
					title: place.name,
					position: place.geometry.location
				}));
				document.getElementById("positionLat").value=(markers[0].getPosition().lat());
				document.getElementById("positionLng").value=(markers[0].getPosition().lng());
			});
		});
	}
</script>
<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBchPTaHoTiH9T2YpWHifSyqFjL4mZIowo&libraries=places&callback=initAutocomplete">
</script>
</html>