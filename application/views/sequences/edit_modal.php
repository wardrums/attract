<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
	<h3>Sequence details</h3>
</div>
<div class="modal-body">
	<?php $attributes = array('class' => 'form-horizontal', 'id' => 'new-sequence'); ?>
	<?php echo form_open("sequences/edit/" . $sequence['sequence_id'], $attributes);?>
	<?php echo form_hidden('sequence_id', $sequence['sequence_id']); ?>
	<fieldset>
	
	<!-- Text input-->
	<div class="control-group">
		<label class="control-label" for="sequence_name">Sequence name</label>
		<div class="controls">
			<input id="sequence_name" name="sequence_name" value="<?php print_r($sequence['sequence_name']); ?>" class="input-xlarge" type="text" required="">
			<p class="help-block">enter the sequence name, e.g. "Tube"</p>
		</div>
	</div>
	
	<!-- Text input-->
	<div class="control-group">
	  <label class="control-label" for="sequence_description">Sequence description</label>
	  <div class="controls">
	    <input id="sequence_description" name="sequence_description" value="<?php print_r($sequence['sequence_description']); ?>" class="input-xlarge" required="" type="text">
	    <p class="help-block">a brief description of the sequence</p>
	  </div>
	</div>


	</fieldset>
	<?php echo form_close();?>
</div>
<div class="modal-footer">
	<a href="/sequences/delete/<?php echo $sequence['sequence_id']; ?>" id="delete" class="btn btn-danger pull-left"><i class="icon-fire icon-white"></i> Delete</a>
	<button type="submit" id="submit" class="btn btn-primary" >Save Changes</button>
	<button class="btn" data-dismiss="modal">Cancel</button>
</div>
<script src="<?php echo assets_url(); ?>/js/jquery.validate.min.js"></script>
<script>
	
	var validator = $( "#new-sequence" ).validate();
		
	$('#submit').click(function(){
		if (validator.form()) {
			$('.modal-body > form').submit();
		} else {
			return false;
		}
		
	});
	

</script>

