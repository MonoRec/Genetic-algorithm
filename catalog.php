<?php session_start(); ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Piccolo Theme</title>
	<?php include "includes/head.php"; ?>
	<?php include 'classes.php'; ?>
    <style type="text/css">
        #map {
            height:310px
        }
    </style>
</head>

<body>

    <?php include "includes/header.php"; ?>
    <!-- End Header -->
    
    <!-- Blog Content
    ================================================== --> 
    <div class="row">

        <?php
        $catalog = new CatalogController();
        $categories = $catalog->showCategories();
        include 'views/Catalog/catalog-all-categoires.php';
        ?>



        <!-- Blog Posts
        ================================================== --> 
        <div class="span8 blog">
        	<?php 

        	$action = isset($_GET['act']) ? $_GET['act'] : NULL;
        	$order = new OrderController();

            if(isset($_POST["btn-order-add"])) {
                $error = $order->add_new_order();
            }

            if(isset($_POST["btn-search"])) {
              $catalog  = new SearchController();  
              $categories = $catalog->searchProduct(); 
              if(isset($categories) && $categories)
                 include 'views/Catalog/catalog-category.php';
             else
                 include 'views/Catalog/no-product.php';

         } else {
          $catalog = new CatalogController();
          if (!$action) { 
            $categories = $catalog->showOffersInCategory();
            include 'views/Catalog/catalog-category.php';
        } 


        if($action == 'showCategory') {
         $categories = $catalog->showOffersInCategory();
         if(isset($categories) && $categories)
            include 'views/Catalog/catalog-category.php';
        else
            echo " No Products";
    }

    if($action == 'show') {
     $product = $catalog->showProductDetail();
     if($product)
        include 'views/Catalog/product-detail.php';
    else
        echo " No Products";
} 
}
?>

</div>

        <!-- Sidebar
        ================================================== -->  
        <?php include 'includes/sidebar.php'; ?>


    </div>
    
</div> <!-- End Container -->
<?php include 'includes/footer.php'; ?>

</body>
<script type="text/javascript">

	$(document).ready(function() {
		$('#example thead th').each(function() {
			var title = $('#example thead th').eq($(this).index()).text();
			
            $(this).html( '<i class="icon-filter"></i> <input type="text" class="form-control" placeholder="'+title+'" />' );

        });
		var table = $('#example').DataTable( {
			"lengthChange": false,	
            "sDom": '<"top"flp>rt<"bottom"i><"clear">',
            
        });
		table.columns().eq(0).each(function(colIdx) {
			$('input', table.column(colIdx).header()).on('keyup change', function() {
				table
				.column(colIdx)
				.search(this.value)
				.draw();
			});

			$('input', table.column(colIdx).header()).on('click', function(e) {
                console.log('test');
                e.stopPropagation();
            });
		});
        $( "#example_paginate" ).addClass( "pagination" );
        $( "#example_paginate" ).css( "text-align","center" );
        $( "#example_filter" ).css( "display","none" );
    } )
</script>
</html>


