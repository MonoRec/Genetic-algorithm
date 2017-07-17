<?php

$main = new MainPage();   
$users = new UserController();
$admin = new AdminPanel();

$profile = new ProfilePanel();
$routePanel = new RoutesPanel();
$orderPanel = new OrderPanel();
$offerPanel = new OfferPanel();

?>

<ul class="nav">

 <?php 

 echo "<li>".$main->click_catalog()."</li>";
 echo "<li><a href='contact.php'> Contact </a></li>";
 echo "<li><a href='about.php'> About Us </a></li>";

if(isset($_SESSION["user_admin"]) && ($_SESSION["user_admin"] == 1)) { 

  echo "";
  echo "<li class='alert-danger'>".$admin->clickOffers()."</li>";
  echo "<li class='alert-danger'>".$admin->clickSuppliers()."</li>";
  echo "<li class='alert-danger'>".$admin->clickCustomers()."</li>";
  echo "<li class='alert-danger'>".$admin->clickCategories()."</li>"; 
  echo "";

} else if(isset($_SESSION["user_type"]) && ($_SESSION["user_type"] == 0) ) { 

   echo "<li>".$offerPanel->click_show_offers()."</li>";
   echo "<li>".$routePanel->clikcAddRoutes()."</li>"; 
   echo "<li>".$routePanel->clickShowRoutes()."</li>";
   // echo "<li>".$profile->clickProfile()."</li>";

 } else if(isset($_SESSION["user_type"]) && $_SESSION["user_type"]  == 0 ) { 

   echo "<li>".$orderPanel->click_show_orders()."</li>";
   // echo "<li>".$profile->clickProfile()."</li>";
 }

 if($users->is_loggedin()) {

   echo "<li>".$main->click_logot()."</li>";
   // echo "<li>".$profile->clickProfile()."</li>";

 } else {

   echo "<li>".$main->click_login()."</li>";
   echo "<li>".$main->click_registration()."</li>";

 } ?>
</ul>


