<h2>Create a shot</h2>

<?php echo validation_errors(); ?>

<?php 
	$attributes = array('class' => 'form-horizontal');
	echo form_open('shots/create', $attributes) 
?>

<fieldset>

<!-- Form Name -->
<legend>Shot details</legend>

<!-- Hidden inputs-->
<?php echo form_hidden('user_id', 3); ?>
<?php echo form_hidden('shot_order', $shot_order); ?>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="shot_name">Name</label>
  <div class="controls">
    <input id="shot_name" name="shot_name" placeholder="" class="input-xlarge" required="" type="text">
    <p class="help-block">Shot name, such as "a2s32"</p>
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="shot_description">Shot description</label>
  <div class="controls">                     
    <textarea id="shot_description" name="shot_description"></textarea>
  </div>
</div>

<!-- Select Scene -->
<div class="control-group">
	<label class="control-label" for="scene_id">Scene</label>
	<div class="controls">
		<select id="scene_id" name="scene_id" class="input-xlarge">
	      	<?php foreach ($scenes as $scene): ?>
				<option value="<?php echo $scene['scene_id'] ?>"><?php echo $scene['scene_name'] ?></option>
			<?php endforeach ?>
	    </select>
  	</div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="shot_duration">Shot duration</label>
  <div class="controls">
    <input id="shot_duration" name="shot_duration" placeholder="" class="input-xlarge" required="" type="text">
    <p class="help-block">Duration of the shot in frames</p>
  </div>
</div>

<!-- Select Status -->
<div class="control-group">
	<label class="control-label" for="status_id">Status</label>
	<div class="controls">
		<select id="status_id" name="status_id" class="input-xlarge">
	      	<?php foreach ($statuses as $status): ?>
				<option value="<?php echo $status['shot_status_id'] ?>"><?php echo $status['shot_status_name'] ?></option>
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
				<option value="<?php echo $stage['shot_stage_id'] ?>"><?php echo $stage['shot_stage_name'] ?></option>
			<?php endforeach ?>
	    </select>
  	</div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit">Submit</label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-inverse">Create Shot</button>
  </div>
</div>


</fieldset>
</form>
