<?php
include 'classes.php';


$arr = $_POST["obj"];

$controller = new Routes();
$controller->setCoordinates($arr);
$controller->setCitiesCount($_POST["size"]);
$controller->setCoefficientOfCrossing(70);
$controller->setCoefficientOfMutation(5);
$controller->Main();
$places = $controller->getCoordinates();
?>

<form id="theForm" method="post"> 
  <input type="hidden" name="addresses" value="<?php  echo implode(" | ", $places); ?>">
  <input type="hidden" name="orders" value="<?php echo implode(",", $_POST["orders"]); ?>">
  <input type="submit" name="Save route">
</form>

<script>  
  var direction;
  var path = '<?php echo $controller->getFinalResult() ?>'.slice(1, -1);

  $(document).ready(function () {
  	calculateAndDisplayRoute(directionsService, directionsDisplay);
  });

  $("#theForm").submit(function(e) {
    var url = "ajax-add-route.php";
    $.ajax({
     type: "POST",
     url: url,
     data: $("#theForm").serialize(),
     success: function(data) {
     }
   });
    e.preventDefault();
  });

  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  	var waypts = [];
  	var fullPath = 0.0;
  	var checkboxArray = document.getElementById('waypoints');

    for(var i = 0; i < path.length; i++) {
     for (var j = 0; j < placePHP.length; j++) {
      if(path[i] == placePHP[j].Key) {
       waypts.push({
        location: placePHP[j].place,
        stopover: true
      });
     }
   }
 }
 directionsService.route({
  origin: placePHP[0].place,
  destination: placePHP[0].place,
  waypoints: waypts,              
  // optimizeWaypoints: true,
  travelMode: 'DRIVING',
}, function(response, status) {
  if (status === 'OK') {
   directionsDisplay.setDirections(response);
   var route = response.routes[0];
   var summaryPanel = document.getElementById('directions-panel');
   summaryPanel.innerHTML = '';
   for (var i = 0; i < route.legs.length; i++) {
     var routeSegment = i + 1;
     summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +'</b><br>';
     summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
     summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
     summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
     var dist = parseFloat(route.legs[i].distance.text.substring(0, route.legs[i].distance.text.length - 3));
     fullPath += dist;
   }
 } else {
   window.alert('Directions request failed due to ' + status);
 }
});
}
</script>