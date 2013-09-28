<?php 
$validation_errors = validation_errors();

if ($this->session->flashdata('message') != '')
	{
	    $flahsdata = $this->session->flashdata('message'); 
	}
?>

<?php if ($validation_errors):?>
<div class="alert">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $validation_errors ?>
</div>
<?php endif ?>

<?php if (isset($flahsdata)):?>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<?php echo $flahsdata ?>
</div>
<?php endif ?>

<?php $attributes = array('class' => 'form-horizontal'); ?>
<?php echo form_open("scenes/create", $attributes);?>
<fieldset>

	<!-- Form Name -->
	<legend>Create scene</legend>
	
	<!-- Text input for scene name -->
	<div class="control-group">
		<label class="control-label" for="scene_name">Scene name</label>
		<div class="controls">
			<input id="scene_name" name="scene_name" placeholder="" class="input-xlarge" required="" type="text">
			<p class="help-block">enter the scene name, e.g. "a1s07"</p>
		</div>
	</div>
	
	<!-- Text input for scene description -->
	<div class="control-group">
		<label class="control-label" for="scene_description">Scene description</label>
		<div class="controls">
			<input id="scene_description" name="scene_description" placeholder="" class="input-xlarge" type="text">
			<p class="help-block">enter a brief description of the scene</p>
		</div>
	</div>
	
	<!-- Select Basic -->
	<div class="control-group">
		<label class="control-label" for="sequence_id">Sequence</label>
	  	<div class="controls">
	    	<select id="sequence_id" name="sequence_id" class="input-xlarge">
	    		<?php foreach ($sequences as $sequence): ?>
	      		<option value="<?php echo $sequence['sequence_id']; ?>"><?php echo $sequence['sequence_name']; ?></option>
	      		<?php endforeach; ?>
	    	</select>
	  	</div>
	</div>
	
	<!-- Button -->
	<div class="control-group">
		<label class="control-label" for="submit">Submit</label>
		<div class="controls">
			<button id="submit" name="submit" class="btn btn-inverse">Create scene</button>
		</div>
	</div>


</fieldset>
<?php echo form_close();?>

