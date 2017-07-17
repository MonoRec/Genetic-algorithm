<div class="span2 sidebar">
 <h5 class="title-bg">Categories</h5>
 <ul class="post-category-list">
 	<?php foreach ($categories as $key => $category): 
 	echo "<li>
 	<a href='catalog.php?act=showCategory&id=".$category->category_id."'>".$category->category_name;
 		if($category->Count <= 0)
 			echo "<span class='pull-right'>0</span>";
 		else
 			echo "<span class='pull-right'>".$category->Count."</span>";
 		echo "</a></li>";
 		endforeach; ?>
 	</ul>
</div>