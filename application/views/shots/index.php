<h2><?php echo $title ?></h2>
<ul>
	<?php foreach ($shots as $shot): ?>
    	<li><a href="/index.php/shots/view/<?php echo $shot['id'] ?>"><?php echo $shot['name'] ?></a> - <?php echo $shot['description'] ?> - <?php echo $shot['user_first_name']?></li>
	<?php endforeach ?>
</ul>