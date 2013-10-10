<div class="span9">
<?php
	echo '<h2>'.$shot['shot_name'].'</h2>';
	echo '<p>'.$shot['shot_description'].'</p>';
	echo '<p>'.$shot['shot_name'].'</p>';
?>


<a class="btn btn-small" href="/shots/edit/<?php echo $shot['shot_id'] ?>"><i class="icon-edit"></i></i> Edit</a>

</div>