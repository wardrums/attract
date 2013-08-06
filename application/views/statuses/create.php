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
<?php echo form_open("statuses/create", $attributes);?>
<fieldset>

<!-- Form Name -->
<legend>Shot stage details</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="status_name">Status name</label>
  <div class="controls">
    <input id="status_name" name="status_name" placeholder="" class="input-xlarge" required="" type="text">
    <p class="help-block">enter the status name, e.g. "in_progress"</p>
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit">Submit</label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-inverse">Create task</button>
  </div>
</div>


</fieldset>
<?php echo form_close();?>

