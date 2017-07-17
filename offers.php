<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title> Offers</title>
	<?php 
	include "includes/head.php";
	include 'classes.php'; 
	?>
</head>
<body>
	<?php include "includes/header.php"; ?>



	<?php 
	$offerPanel = new offerPanel();
	$userOffer = new OfferController();
	$catalog = new CatalogController();
	$categories = $catalog->showCategories();
	?>

	<div class="row">
		
			<?php include 'views/Catalog/catalog-all-categoires.php'; ?>      
		
		<div class="span8 blog">
			<?php 
			$action = isset($_GET['act']) ? $_GET['act'] : NULL;
			if($action == 'show_offer') {
				$products = $userOffer->showUserOffers($_SESSION['user_session']);
				include 'views/Offers/users-offers.php';
			} 
			if($action == 'add_offer') {
				include 'views/Offers/add-offer-form.php';
				$userOffer->addOffer();
			}
			if($action == 'edit') {
				$product = $userOffer->editOffer();
				include 'views/Offers/edit-offer-form.php';
			} 
			if($action == 'remove') {
				$userOffer->removeProduct();
			}
			if($action == 'offer') {
				$orderOnOffer = $userOffer->get_offers_on_order();
				include "views/Offers/offer-on-order.php";
			} 
			?>
			</div>
			<?php include 'includes/sidebar.php'; ?>
		

	</div> 
	
   			<?php include 'includes/footer.php'; ?>

</body>
<script>

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



	var directionsDisplay;
	var directionsService;

	function initAutocomplete() {
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -34.397, lng: 150.644},
			zoom: 13,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		});

		var input = document.getElementById('searchTextField');
		var searchBox = new google.maps.places.SearchBox(input);

		map.addListener('bounds_changed', function() {
			searchBox.setBounds(map.getBounds());
		});

		var markers = [];
		searchBox.addListener('places_changed', function() {
			var places = searchBox.getPlaces();

			if (places.length == 0) {
				return;
			}
			markers.forEach(function(marker) {
				marker.setMap(null);
			});
			markers = [];
			var bounds = new google.maps.LatLngBounds();
			places.forEach(function(place) {
				var icon = {
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(25, 25)
				};
				console.log(place.geometry.location);
				markers.push(new google.maps.Marker({
					map: map,
					icon: icon,
					title: place.name,
					position: place.geometry.location
				}));
				document.getElementById("pLat").value=(markers[0].getPosition().lat());
				document.getElementById("pLng").value=(markers[0].getPosition().lng());

				if (place.geometry.viewport) {
					bounds.union(place.geometry.viewport);
				} else {
					bounds.extend(place.geometry.location);
				}
			});
			map.fitBounds(bounds);
		});
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
	}

</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBchPTaHoTiH9T2YpWHifSyqFjL4mZIowo&libraries=places&callback=initAutocomplete">
</script>

</html>