<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
 <title> Routes </title>
 <?php 
 include "includes/head.php";
 include 'classes.php'; 
 ?>
 <body>
  <?php include "includes/header.php"; ?>

  <?php 

  $GA = new GA();
  $offerPanel = new offerPanel();
  $routes = new RoutesController();
  $userOffer = new OfferController();
  $catalog = new CatalogController();
  
  $categories = $catalog->showCategories();
  ?>

  <div class="row">
    <?php include 'views/Catalog/catalog-all-categoires.php'; ?>      
    <div class="span8 blog">
      <?php

      $userOffer = new OfferController();
      $action = isset($_GET['act']) ? $_GET['act'] : NULL;  

      if($action == 'add_route') {
        $userOffer->get_offers_on_order();
      } 

      if($action == 'show_routes') {
        $route = $routes->showUsersRoutes();
        include 'views/Routes/route-list.php';

     }




     if(isset($_POST["route-btn"])) {
      $deliveryPlaces = $_POST["check_list"];
      array_unshift($deliveryPlaces, json_decode($_POST["home"]));
      $buf = array();
      $emptyMatrix = array();
      for ($i=0; $i < sizeof($_POST["check_list"]) + 1; $i++) { 
        for ($j=0; $j < sizeof($_POST["check_list"]) + 1; $j++) { 
          array_push($buf, 0);
        }
        array_push($emptyMatrix, $buf);
        $buf = [];
      }

      $GA->Coordinates = $deliveryPlaces;
      $GA->distanceMatrix = $emptyMatrix;
      $GA->populationSize = sizeof($emptyMatrix);
      $GA->main();
     
      echo '
      <form method="post" id="route-form">
        <input type="hidden" name="places" value='.$GA->points.'>
        <input type="submit" action="__URL__" name="btn-route" class="btn btn-primary btn btn-info" value="save route">
      </form>';

    }
    ?>
  </div>
  <?php include 'includes/sidebar.php'; ?>
</div> 
<?php include 'includes/footer.php'; ?>
</body>
<script>
  $(document).ready(function() {
    $('#offers').DataTable( {
      "lengthChange": false,
      "bFilter" : false,
      "bInfo" : false,
      "sDom": '<"top"flp>rt<"bottom"i><"clear">'
    }); 
    $('#offers thead th').each(function() {
      var title = $('#offers thead th').eq($(this).index()).text();
      
      $(this).html(title+'<br><i class="icon-resize-vertical"></i>');
      
    });
    $( "#offers_paginate" ).addClass( "pagination" );
    $( "#offers_paginate" ).css( "text-align","center" );
    $( "#example_filter" ).css( "display","none" );
  }) 

  $("#route-form").submit(function(e) {
    var url = "ajax-add-routes.php";
    $.ajax({
      type: "POST",
      url: url,
      data: $("#route-form").serialize(),
      success: function(data) {
        console.log(data);
      },
      error: function(data) {
        console.log(data);
      }
    });
    e.preventDefault();
  }); 
</script>
</html>