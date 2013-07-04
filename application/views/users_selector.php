<select name="shot_owners[]" id="shot_owners" data-placeholder="Assign this shot..." class="chzn-select" multiple="multiple">
<?php 
	$shot_users_id = array();
	
	foreach ($active_users as $shot_user):
		array_push($shot_users_id, $shot_user['user_id']);
	endforeach
?>	
			
<?php foreach ($users as $user): ?>
	<option value="<?php echo $user['id'] ?>" <?php echo (in_array($user['id'], $shot_users_id) ? "selected=\"selected\"" : ""); ?>>
		<?php echo $user['first_name'] . ' ' . $user['last_name'] ?>
	</option>
<?php endforeach ?>
</select>