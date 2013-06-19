<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>


<script>
	$(function() {
		$('.dial-lighting').val(<?php echo $shots_stages['lighting'] ?>).trigger('change');
		$('.dial-animation').val(<?php echo $shots_stages['animation'] ?>).trigger('change');
		$('.dial-layout').val(<?php echo $shots_stages['layout'] ?>).trigger('change');
	    
	    $('.dial').knob({
	    	'min':0,
	        'max':100,
	        'readOnly': true,
	        //'value': 34,
	        'width': 150,
	        'height': 150,
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

<h3>Global progress</h3>
<div class="progress">
	<div class="bar bar-success" style="width: <?php echo $shots_statuses['final_1'] ?>%;"></div>
	<div class="bar bar-warning" style="width: <?php echo $shots_statuses['in_progress'] ?>%;"></div>
	<div class="bar bar-danger" style="width: <?php echo $shots_statuses['fix'] ?>%;"></div>
</div>

<hr>

<p>The following values are calculated based on the 'in_progress' shots.</p>

<div class="row-fluid stats-knobs">
	<div class="span3">
		<h4>Layout</h4>
		<p><input type="text" class="dial dial-layout" ></p>
	</div>
	<div class="span3">
		<h4>Animation</h4>
		<p><input type="text" class="dial dial-animation"></p>
	</div>
	<div class="span3">
		<h4>Lighting</h4>
		<p><input type="text" class="dial dial-lighting" ></p>
	</div>
	<div class="span3">
		<h4>Other</h4>
		<input type="text" class="dial">
	</div>
</div>

<h3>Film duration</h3>
<p>Total film duration is <?php echo $total_duration_frames ?> frames, or <?php echo $total_duration_time ?></p>
<h3>Film format</h3>
<p>Film reel is available at the following resolutions </p>
<hr>


</div><!--/span-->



