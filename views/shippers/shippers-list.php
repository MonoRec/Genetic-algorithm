<br><l class=" icon-plane"></l>
<?php foreach ($shippers as $key => $ship): $num = $key+1 ;
	if($key == 0)
		echo $ship->shippers_name."<input style='margin: 0px 13px 0px 3px;' type='radio' value='$num' name='type' checked>";
	else
		echo $ship->shippers_name."<input style='margin: 0px 13px 0px 3px;' type='radio' value='$num' name='type'>";
	endforeach ?>