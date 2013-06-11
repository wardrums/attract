<h2><?php echo $title ?></h2>
<ul>
	<?php foreach ($shots as $shot): ?>
    	<li><?php echo $shot['name'] ?> - <?php echo $shot['description'] ?> - <?php echo $shot['duration'] ?></li>
	<?php endforeach ?>
</ul>