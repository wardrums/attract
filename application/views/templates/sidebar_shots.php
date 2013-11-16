		<div class="col-md-3">
			<div class="list-group">
				<?php foreach ($shots as $item): ?>
		      	<a href="/shots/view/<?php echo $item['shot_id'] ?>" class="list-group-item <?php echo ($item['shot_id'] == $shot['shot_id'] ? "active" : ""); ?>"><?php echo $item['shot_name'] ?></a>
				<?php endforeach ?>
			</div>

        </div><!--/span-->