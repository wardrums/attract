		<div class="span3">
          	<div class="well sidebar-nav">
				<ul class="nav nav-list">
					<li class="nav-header">Shots</li>
			      	<?php foreach ($shots as $item): ?>
			      	<li <?php echo ($item['shot_id'] == $shot['shot_id'] ? "class=\"active\"" : ""); ?>><a href="/shots/view/<?php echo $item['shot_id'] ?>"><?php echo $item['shot_name'] ?></a></li>
			
					<?php endforeach ?>
			
				</ul>
			</div><!--/.well -->
        </div><!--/span-->