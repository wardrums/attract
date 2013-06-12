        <div class="span9">
          <div class="hero-unit">
           <h2><?php echo $title ?></h2>
			<ul>
				<?php foreach ($shots as $shot): ?>
			    	<li><a href="/shots/view/<?php echo $shot['shot_id'] ?>"><?php echo $shot['shot_name'] ?></a> - <?php echo $shot['shot_description'] ?> - <?php echo $shot['user_first_name']?></li>
				<?php endforeach ?>
			</ul>
          </div>
        </div><!--/span-->



