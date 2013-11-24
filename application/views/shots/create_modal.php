<div class="modal-dialog">
    <div class="modal-content">

		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        	<h4 class="modal-title">Create shot</h4>
		</div>
		<div class="modal-body">
			<?php $attributes = array('id' => 'new-shot'); ?>
			<?php echo form_open("/shots/create/", $attributes);?>
			
			<!-- Select Scene -->
			<div class="form-group">
				<label class="control-label" for="scene_id">Scene</label>
				<select id="scene_id" name="scene_id" class="form-control">
			      	<?php foreach ($scenes as $scene): ?>
						<option value="<?php echo $scene['scene_id'] ?>"><?php echo $scene['scene_name'] ?></option>
					<?php endforeach ?>
			    </select>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
				<label class="control-label" for="shot_name">Name</label>
				<input id="shot_name" name="shot_name" class="form-control" type="text" required="">
				<p class="help-block">enter a name for the shot, e.g. "06a_best_grass"</p>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
				<label class="control-label" for="shot_description">Description</label>
				<input id="shot_description" name="shot_description" class="form-control" type="text" required="">
				<p class="help-block">enter a meaningful description, e.g. "We see the best grass"</p>
			</div>
			
			<!-- Text input-->
			<div class="form-group">
				<label class="control-label" for="shot_duration">Duration</label>
				<input id="shot_duration" name="shot_duration" class="form-control" type="text" required="">
				<p class="help-block">Duration of the shot in frames</p>
			</div>
			
			
			<?php echo form_close();?>
		</div>
		<div class="modal-footer">
			<button type="submit" id="submit" class="btn btn-primary" >Add Shot</button>
			<button class="btn btn-default" data-dismiss="modal">Cancel</button>
		</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo assets_url(); ?>/js/jquery.validate.min.js"></script>
<script>	
	var validator = $( "#new-shot" ).validate({
		rules: {
		    shot_duration: {
		      required: true,
		      digits: true
		    }
		  }
	});
		
	$('#submit').click(function(){
		if (validator.form()) {
			$('.modal-body > form').submit();
		} else {
			return false;
		}
		
	});
</script>

