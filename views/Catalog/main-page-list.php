     
<?php foreach ($offerTop as $key => $value): $arr = json_decode($value->product_address); ?>
  <article class="clearfix">
  <a href="catalog.php?act=show&id=<?php echo $value->product_id;?>">
  <img style="height: 128px;" src="uploads/products/<?php echo $value->photo; ?>" alt="Post Thumb" class="align-left"></a>
  
  <h4 class="title-bg"><a href="blog-single.htm"> <l class=" icon-star"></l> <?php echo $value->product_name;?> </a></h4>
  <p>
  <?php echo $value->short_description; ?>
  <?php echo $value->full_description; ?>
  </p>
  <div class="post-summary-footer">
    <ul class="post-data-3">
      <li><i class="icon-calendar"></i> <?php echo $value->date; ?></li>
      <li><i class="icon-map-marker"></i> <?php echo $arr[0]; ?></li>
      <li><i class="icon-tag"></i> <?php echo $value->price.".00$"; ?></li>

    </a></li>
  </ul>
</div>
</article>

<?php endforeach ?>