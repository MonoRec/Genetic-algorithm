<style>
/* Always set the map height explicitly to define the size of the div
* element that contains the map. */
#map {
  width:550px;
  height:400px;

}
/* Optional: Makes the sample page fill the window. */
html, body {
  /*height: 40%;*/
  /*margin: 0;*/
  /*padding: 0;*/
} 

</style>
<h2 class="title-bg">Add product</h2>
<div class="row">
  <div class="span2">

   <form method="POST" action="" enctype="multipart/form-data">
    <div id="div_id_username" class="form-group required">
      <label for="id_username" class="control-label col-md-4  requiredField"> Product name <span class="asteriskField">*</span> </label>
      <div class="controls col-md-8 ">
        <input class="input-md  textinput textInput form-control" id="name" maxlength="30" type="text" name="product_name" placeholder="Choose product name" style="margin-bottom: 10px"/>
      </div>
    </div>
    <div id="div_id_username" class="form-group required">
      <label for="id_username" class="control-label col-md-4  requiredField"> Select image to upload: <span class="asteriskField">*</span> </label>
      <div class="controls col-md-8 ">
        <input class="input-md  textinput textInput form-control"  maxlength="30" type="file" name="fileToUpload" id="fileToUpload" placeholder="Choose your name" style="margin-bottom: 10px" />
      </div>
    </div>
    <div id="div_id_username" class="form-group required">
      <label for="id_username" class="control-label col-md-4  requiredField"> Short description <span class="asteriskField">*</span> </label>
      <div class="controls col-md-8 ">
        <input class="input-md  textinput textInput form-control" id="id_username" maxlength="30" name="description_short" placeholder="Product description" style="margin-bottom: 10px" type="text" />
      </div>
    </div>
    <div id="div_id_username" class="form-group required">
      <label for="id_username" class="control-label col-md-4  requiredField"> Full description </label>
      <div class="controls col-md-8 ">
        <input class="input-md  textinput textInput form-control" id="id_username" maxlength="30" name="description_long" placeholder="Choose your username" style="margin-bottom: 10px" type="text" />
      </div>
    </div>
    <div id="div_id_username" class="form-group required">
      <label for="id_username" class="control-label col-md-4  requiredField"> Quantity<span class="asteriskField">*</span> </label>
      <div class="controls col-md-8 ">
        <input class="input-md  textinput textInput form-control" id="id_username" maxlength="30" name="quantity" placeholder="Quantity of product" style="margin-bottom: 10px" type="text" />
      </div>
    </div>
    <div id="div_id_email" class="form-group required">
      <label for="id_email" class="control-label col-md-4"> Price<span class="asteriskField">*</span> </label>
      <div class="controls col-md-8 ">
        <input class="input-md form-control" id="discount" name="price" placeholder="Price 0.00$" style="margin-bottom: 10px" />
      </div>     
    </div>
    <div id="div_id_email" class="form-group required">
      <label for="location" class="control-label col-md-4"> Location<span class="asteriskField">*</span> </label>
      <div class="controls col-md-8 ">
        <input id="searchTextField" class="input-md form-control" placeholder="Enter Addres" name="addres" type="text" size="50">
      </div>     
    </div>
    <?php 
    $categories = new CategoryController();
    $categories = $categories->showCategories(); 
    include 'views/Categories/category-list.php';   
    ?> 
    <div class="form-group"> 
      <div class="aab controls col-md-4 "></div>
      <div class="controls col-md-8 "> 
        <!-- <input type="hidden" name="form-submitted" value="1" /> -->
        <input type="hidden" name="positionLng" id="pLat" required>
        <input type="hidden" name="positionLat" id="pLng" required>
        <input type="submit" name="form-submitted" value="Add product" class="btn btn-primary btn btn-info" id="submit-id-signup" />
      </div>
    </div> 
  </form>
</div>
<div class="span3">
  <div id="map"></div>
</div>
</div>
<script>
  var a = 10;

  var arrMarkers= new Array();
  var arr = new Array();

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

    google.maps.event.addListener(map, 'click', function(event) {
      var marker = new google.maps.Marker({
        position: event.latLng, 
        map: map
      });
      arrMarkers.push(marker.getPosition().lat() + "-" + marker.getPosition().lng());
      console.log(arrMarkers);
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
