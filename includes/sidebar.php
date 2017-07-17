<?php 
$order = new OrderController(); 
$product = new OfferController();
$profile = new profilePanel();
$orderPanel = new OrderPanel();
$offerPanel = new OfferPanel(); 
$routePanel = new RoutesPanel(); 
$search = new SearchPanel();
?>       


<div class="span2 sidebar">

  <?php $search->showSearchForm(); ?>
  



  <?php if(isset($_SESSION) && !empty($_SESSION)) { ?>   
  <h5 class="title-bg">User menu</h5>
  <ul class="post-category-list">
   
   <?php if( $_SESSION["user_type"] == 1 ) { ?>
   
   <li> <?php echo $orderPanel->click_show_orders(); ?> <l class="icon-bell alert-danger"></l><strong class="alert-success">  <?php echo $order->selectCountOrders($_SESSION['user_session'],"orders","customer_ID"); ?> </strong> </li> 
   <?php } if( $_SESSION["user_type"] == 0 ) { ?> 
   
   <li> <?php  echo $offerPanel->click_show_offers(); ?> <l class="icon-bell"> </l><strong class="alert-success"> <?php echo $product->selectCountOffers($_SESSION['user_session'], "products","supplier_ID"); ?> </strong> </li>
   
   <li> <?php echo $offerPanel->click_add_offer(); ?> </li>
   
   <li> <?php echo $routePanel->clikcAddRoutes(); ?> </li>
   
   <li> <?php echo $routePanel->clickShowRoutes(); ?> </li>
   <?php } ?>

   <li> <?php echo $profile->clickProfile(); ?> </li> 
 </ul>
 <?php } else { include 'views/users/login-form.php'; } ?>


 <?php


  $query = $product->getPopularOffers();
  include "views/Offers/top-offers.php";
  $query = $product->getPopularSellers();
  include "views/Offers/top-sellers.php";

 ?>

