<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>


<script>
	$(function() {
		<?php foreach ($tasks as $task_name => $value): ?>
			<?php foreach ($value['statuses'] as $status_name => $status_count): ?>
				$('.dial-<?php echo $task_name ?>-<?php echo $status_name ?>').val(<?php echo $status_count ?>).trigger('change');
			<?php endforeach ?>
		<?php endforeach ?>
	    
	    $('.dial').knob({
	    	'min':0,
	        //'max':100,
	        'readOnly': true,
	        //'value': 34,
	        'width': 120,
	        'height': 120,
	        'fgColor': '#333',
	        'dynamicDraw': true,
	        'thickness': 0.2,
	        'tickColorizeValues': true,
			'skin':'tron'
	    });

	});
</script>


<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<?php foreach ($tasks as $task_name => $value): ?>
<?php $count = 0; ?>
<h3><?php echo $task_name; ?></h3>

<div class="row-fluid stats-knobs">
	<?php foreach ($value['statuses'] as $status_name => $status): ?>
	<div class="span2<?php $count == 0 ? print(" offset1") : print(""); ?>">
		<h4><?php echo $status_name ?></h4>
		<p><input type="text" data-max="<?php echo $value['tasks_count']; ?>" class="dial dial-<?php echo $task_name ?>-<?php echo $status_name ?>" ></p>
	</div>
	<?php $count++; ?>
	<?php endforeach ?>
</div>

<?php endforeach ?>

<h3>Global progress</h3>
<div class="progress">
	<div class="bar bar-success" style="width: 50%;"></div>
	<div class="bar bar-warning" style="width: 10%;"></div>
	<div class="bar bar-danger" style="width: 15%;"></div>
</div>

<hr>



<h3>Film duration</h3>
<p>Total film duration is <?php echo $total_duration_frames ?> frames, or <?php echo $total_duration_time ?></p>
<h3>Film format</h3>
<p>Film reel is available at the following resolutions </p>
<hr>


</div><!--/span-->



