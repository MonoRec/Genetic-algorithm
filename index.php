<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<head>
  <title> Home page</title>
  <?php 
  include "includes/head.php";
  include 'classes.php'; 
  ?>
</head>
<body>
  <?php include "includes/header.php"; ?>
  <div class="row" style="    margin-bottom: 39px;">

    <?php
    $catalog = new CatalogController();
    $categories = $catalog->showCategories();
    include 'views/Catalog/catalog-all-categoires.php';
    ?>

    <div class="span8 blog">
    <?php 
$product = new OfferController();  
$offerTop = $product->getPopularOffers();
?>
<?php include 'views/Catalog/main-page-list.php'; ?>

  </div>

  <?php include 'includes/sidebar.php'; ?>
</div> 
</div> 
<?php include 'includes/footer.php'; ?>
</body>
</html>
