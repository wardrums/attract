<?php 
$validation_errors = validation_errors();

if ($this->session->flashdata('message') != '')
	{
	    $flahsdata = $this->session->flashdata('message'); 
	}
?>
<?php if($validation_errors):?>
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
<?php echo form_open("sequences/create", $attributes);?>
<fieldset>

<!-- Form Name -->
<legend>Sequence details</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="sequence_name">Sequence name</label>
  <div class="controls">
    <input id="sequence_name" name="sequence_name" placeholder="" class="input-xlarge" required="" type="text">
    <p class="help-block">enter the sequence name, e.g. "Tube"</p>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="sequence_description">Sequence description</label>
  <div class="controls">
    <input id="sequence_description" name="sequence_description" placeholder="" class="input-xlarge" required="" type="text">
    <p class="help-block">a brief description of the sequence</p>
  </div>
</div>


<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit">Submit</label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-inverse">Create sequence</button>
  </div>
</div>


</fieldset>
<?php echo form_close();?>

