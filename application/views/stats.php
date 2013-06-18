<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<h3>Fake global progress</h3>
<div class="progress">
	<div class="bar bar-success" style="width: <?php echo $shots_statuses['final_1'] ?>%;"></div>
	<div class="bar bar-warning" style="width: <?php echo $shots_statuses['in_progress'] ?>%;"></div>
	<div class="bar bar-danger" style="width: <?php echo $shots_statuses['fix'] ?>%;"></div>
</div>

<div class="row-fluid">
	<div class="span3">
		<h4>Layout</h4>
	</div>
	<div class="span3">
		<h4>Animation</h4>
	</div>
	<div class="span3">
		<h4>Lighting</h4>
	</div>
	<div class="span3">
		<h4>Other</h4>
	</div>
</div>

<h3>Film duration</h3>
<p>Total film duration is <?php echo $total_duration_frames ?> frames, or <?php echo $total_duration_time ?></p>
<h3>Film format</h3>
<p>Film reel is available at the following resolutions </p>
<hr>


</div><!--/span-->



