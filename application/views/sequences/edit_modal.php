<div class="modal-header">
	<a class="close" data-dismiss="modal">&times;</a>
	<h3>Sequence details</h3>
</div>
<div class="modal-body">
	<?php $attributes = array('class' => 'form-horizontal'); ?>
	<?php echo form_open("sequences/edit/" . $sequence['sequence_id'], $attributes);?>
	<?php echo form_hidden('sequence_id', $sequence['sequence_id']); ?>
	<fieldset>
	
	<!-- Text input-->
	<div class="control-group">
		<label class="control-label" for="sequence_name">Sequence name</label>
		<div class="controls">
			<input id="sequence_name" name="sequence_name" value="<?php print_r($sequence['sequence_name']); ?>" class="input-xlarge" required="" type="text">
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
	<button id="submit" class="btn btn-primary" onclick="$('.modal-body > form').submit();">Save Changes</button>
	<button class="btn" data-dismiss="modal">Close</button>
</div>