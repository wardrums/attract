<?php $span_value = ($use_sidebar == TRUE ? "col-md-9" : "col-md-12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="users">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Group</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user):?>
		
		<tr>
			<td><?php echo $user->first_name;?> <?php echo $user->last_name;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<span class="label label-default"><?php echo $group->name;?></span>
                <?php endforeach?>
			</td>
			<td>
				<div class="btn-group">
				  <?php echo anchor("auth/edit_user/".$user->id, 'Edit', 'class="btn btn-default btn-xs"') ;?>
				  <button class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu pull-right">
				    <li><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></li>
				    <li><?php echo(anchor('/admin/_post_delete_user/'.$user->id , 'Delete')) ?></li>
				  </ul>
				</div>
			</td>
		</tr>
	<?php endforeach;?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Group</th>
			<th>Edit</th>
		</tr>
	</tfoot>
</table>


</div><!--/span-->



