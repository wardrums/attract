<h2>Edit</h2>

<?php echo validation_errors(); ?>

<?php 
	$attributes = array('class' => 'form-horizontal');
	echo form_open('shots/edit/' . $shot['shot_id'] , $attributes) 
?>

<fieldset>

<!-- Form Name -->
<legend>Shot details</legend>

<input type="hidden" name="shot_id" value="<?php echo $shot['shot_id'] ?>" />

<!-- Text input-->
<div class="control-group">
	  <label class="control-label" for="shot_name">Name</label>
	  <div class="controls">
		    <input id="shot_name" name="shot_name" value="<?php echo $shot['shot_name']; ?>" class="input-xlarge" required="" type="text">
		    <p class="help-block">Shot name, such as "a2s32"</p>
	  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  	<label class="control-label" for="shot_description">Shot description</label>
  	<div class="controls">                     
    	<textarea id="shot_description" name="shot_description"><?php echo $shot['shot_description']; ?></textarea>
  	</div>
</div>

<!-- Textarea -->
<div class="control-group">
  	<label class="control-label" for="shot_notes">Notes</label>
  	<div class="controls">                     
    	<textarea id="shot_notes" name="shot_notes"><?php echo $shot['shot_notes']; ?></textarea>
  	</div>
</div>

<!-- Select Scene -->
<div class="control-group">
	<label class="control-label" for="scene_id">Scene</label>
	<div class="controls">
		<select id="scene_id" name="scene_id" class="input-xlarge">
	      	<?php foreach ($scenes as $scene): ?>
				<option value="<?php echo $scene['scene_id'] ?>"  <?php echo ($scene['scene_id'] == $shot['scene_id'] ? "selected=\"selected\"" : ""); ?>><?php echo $scene['scene_name'] ?></option>
			<?php endforeach ?>
	    </select>
  	</div>
</div>

<!-- Select Status -->
<div class="control-group">
	<label class="control-label" for="status_id">Status</label>
	<div class="controls">
		<select id="status_id" name="status_id" class="input-xlarge">
	      	<?php foreach ($statuses as $status): ?>
				<option value="<?php echo $status['shot_status_id'] ?>"  <?php echo ($status['shot_status_id'] == $shot['shot_status_id'] ? "selected=\"selected\"" : ""); ?>><?php echo $status['shot_status_name'] ?></option>
			<?php endforeach ?>
	    </select>
  	</div>
</div>

<!-- Select Stage -->
<div class="control-group">
	<label class="control-label" for="stage_id">Stage</label>
	<div class="controls">
		<select id="stage_id" name="stage_id" class="input-xlarge">
	      	<?php foreach ($stages as $stage): ?>
				<option value="<?php echo $stage['shot_stage_id'] ?>"  <?php echo ($stage['shot_stage_id'] == $shot['shot_stage_id'] ? "selected=\"selected\"" : ""); ?>><?php echo $stage['shot_stage_name'] ?></option>
			<?php endforeach ?>
	    </select>
  	</div>
</div>



<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="shot_duration">Shot duration</label>
  <div class="controls">
    <input id="shot_duration" name="shot_duration" value="<?php echo $shot['shot_duration']; ?>" class="input-xlarge" required="" type="text">
    <p class="help-block">Duration of the shot in frames</p>
  </div>
</div>

<!-- Select Multiple -->
<div class="control-group">
  <label class="control-label" for="shot_owners">Owners</label>
  <div class="controls">
    <select id="shot_owners" name="shot_owners" class="input-xlarge" multiple="multiple">
	<?php foreach ($scenes as $scene): ?>
		<option><?php echo $scene['scene_name'] ?></option>
	<?php endforeach ?>
    </select>
  </div>
</div>



<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit">Submit</label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-inverse">Edit Shot</button>
  </div>
</div>

</fieldset>
</form>
