<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
			<th>Group</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->first_name;?></td>
			<td><?php echo $user->last_name;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
			<th>Group</th>
			<th>Status</th>
			<th>Edit</th>
		</tr>
	</tfoot>
</table>


</div><!--/span-->



