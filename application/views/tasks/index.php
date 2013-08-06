<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>Task ID</th>
			<th>Task name</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($tasks as $task): ?>
    	<tr>
    		<td><?php echo $task['task_id'] ?></td>
    		<td><a href="/users/edit/<?php echo $task['task_id'] ?>"><?php echo $task['task_name'] ?></a></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Task ID</th>
			<th>Task name</th>
		</tr>
	</tfoot>
</table>

<a class="btn btn-large btn-block" href="/admin/tasks_create/">Add task</a>
</div><!--/span-->



