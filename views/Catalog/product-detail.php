<?php 

$arr = json_decode($product[0]->product_address);?>

<br>
<div id="map"></div>


<br>

<div class='row'>
  <div class='span5'>
    <?php  echo "<h3>".$product[0]->product_name."</h3><h4>".$product[0]->product_name."</h4>"; ?>

    <i class="icon-user"></i>
    <?php  echo $product[0]->first_name.",".$product[0]->second_name; ?>
    <br>
    <i class="icon-map-marker"></i>
    <?php  echo $arr[0];?>
    <br>    
    <i class='icon-shopping-cart'> </i>
    <?php echo $product[0]->price.".00 $"; ?>
    <br>
    <i class="icon-ok-circle"></i>
    <?php echo $product[0]->phone; ?>
    <br>
    <i class="icon-envelope"></i>
    <?php echo $product[0]->email; ?> 
    <br>
    <i class="icon-shopping-cart"></i>
    <?php echo $product[0]->quantity; ?>
    <br> 
    <?php 



    if (isset($_SESSION["user_type"]) &&  $_SESSION["user_type"] == 0 ) { ?>
    <form method="POST" action="">
      <input type="hidden" id="lat" value="<?php echo $arr[1]->Lat; ?>">
      <input type="hidden" id="lng" value="<?php echo $arr[2]->Lng; ?>">
      <input type="hidden" id="address" value="<?php echo $arr[0]; ?>"><input id="searchTextField" type="hidden" name="addresss" type="text" size="50" />
    </form>
    <?php } ?>

  </div>
  <div class='span2'>
    <img id="product-img" src="/uploads/products/<?php echo $product[0]->photo; ?>" alt="photo"  width:150px; height:150px;" >
    &nbsp;
  </div>
</div>
<!-- <?php var_dump($_SESSION); ?> -->
<?php if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == 1) { ?>
<form method="POST" action="">
 
 <!-- <span class="glyphicon glyphicon-globe btn-lg" aria-hidden="true"></span> <br> -->
 

<i class="icon-map-marker"></i>Address
 <input id="searchTextField" name="addressDelivery" type="text" size="50" /> 
 <p id="duration-distance"></p>
 <p id="warnings-panel"></p>
 <input id="start" type="hidden" name="address" value="<?php echo $arr[0]; ?>">
 <input id="end" type="hidden" name="address" value="<?php echo $arr[0]; ?>">
<i class=" icon-tag"></i>
 <span class="input-group">Quentity</span>
 <input type="text" name="quantity" class="form-control" required>


 <?php	
 $controller = new ShippersController();
 $shippers = $controller->showShippersList();
 include 'views/shippers/shippers-list.php';
 ?>
 <br>

 <input type="hidden" id="lat_order" name="lat-order">
 <input type="hidden" id="lng_order" name="lng-order">
 <input type="hidden" name="product_id" value="<?php echo $product[0]->product_id; ?>">
 <input type="hidden" name="product_quantity" value="<?php echo $product[0]->quantity; ?>">
 <input type="hidden" id="lat" value="<?php echo $arr[1]->Lat; ?>">
 <input type="hidden" id="lng" value="<?php echo $arr[2]->Lng; ?>">
 <input type="hidden" id="address" value="<?php echo $arr[0]; ?>">
 <input type="hidden" name="price">
 

 
 <label for="comment">Description:</label>
 <textarea class="form-control" rows="2" id="comment" name="description"></textarea>
 <button type="submit" class="btn btn-default btn-lg" name="btn-order-add">
  <span class="glyphicon glyphicon-ok-sign alert-success" aria-hidden="true"></span> Buy
</button>

</form>
<?php } ?>
<script>
	console.log( parseFloat(document.getElementById('lat').value));
	console.log( parseFloat(document.getElementById('lng').value));
  console.log(document.getElementById('address').value);
  var markersArray = [];

  function clearOverlays() {
    for (var i = 0; i < markersArray.length; i++ ) {
     markersArray[i].setMap(null);
   }
   markersArray.length = 0;
 }

 function initMap() {

        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        // Create a map and center it on Manhattan.
        var map = new google.maps.Map(document.getElementById('map'), {
        	zoom: 13,
        	center: {
        		lat: parseFloat(document.getElementById('lat').value), 
        		lng: parseFloat(document.getElementById('lng').value)
        	}
        });

  		// Create the search box and link it to the UI element.
  		var input = document.getElementById('searchTextField');
  		var searchBox = new google.maps.places.SearchBox(input);

  		map.addListener('bounds_changed', function() {
  			searchBox.setBounds(map.getBounds());
  		});

  		var geocoder = new google.maps.Geocoder();
  		geocodeAddress(geocoder, map);	
  		searchBox.addListener('places_changed', function() {
  			clearOverlays();

  			var places = searchBox.getPlaces();
  			places.forEach(function(place) {
  				console.log(place.geometry.location);
  				var marker = new google.maps.Marker({
  					map: map,
  					position: place.geometry.location
  				});
  				document.getElementById('lng_order').value = parseFloat(marker.getPosition().lat());
  				document.getElementById('lat_order').value = parseFloat(marker.getPosition().lng());

  			});

  			if (places.length == 0) {
  				return;
  			}
    	// For each place, get the icon, name and location.
    	var bounds = new google.maps.LatLngBounds();
    	// console.log(bounds);
    	
    	map.fitBounds(bounds); 
    	calculateAndDisplayRoute(directionsDisplay, directionsService, stepDisplay, map);
    });

        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map});
        // Instantiate an info window to hold step text.
        var stepDisplay = new google.maps.InfoWindow;
      }

      function calculateAndDisplayRoute(directionsDisplay, directionsService, stepDisplay, map) {

       directionsService.route({
        origin: document.getElementById('address').value,
        destination: document.getElementById('searchTextField').value,
        travelMode: 'DRIVING'
      }, function(response, status) {

        if (status === 'OK') {
         document.getElementById('warnings-panel').innerHTML ='<b>' + response.routes[0].warnings + '</b>';
         directionsDisplay.setDirections(response);
       } else {
         window.alert('Directions request failed due to ' + status);
       }
       var distance = response.routes[0].legs[0].distance.text;
       var duration = response.routes[0].legs[0].duration.text;

       document.getElementById('duration-distance').innerHTML = 'Distence: ' + distance + ' Time: ' + duration;
     });
     }

     function geocodeAddress(geocoder, resultsMap) {
       var address = document.getElementById('address').value;
       geocoder.geocode({'address': address}, function(results, status) {
        if (status === 'OK') {
         resultsMap.setCenter(results[0].geometry.location);
         var marker = new google.maps.Marker({
          map: resultsMap,
          position: results[0].geometry.location
        });
         markersArray.push(marker);
       } else {
         alert('Geocode was not successful for the following reason: ' + status);
       }
     });
     }

   </script>
   <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBchPTaHoTiH9T2YpWHifSyqFjL4mZIowo&libraries=places&callback=initMap">
 </script>