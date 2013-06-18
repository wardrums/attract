<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>User ID</th>
			<th>Username</th>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
			<th>Group</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($users as $user): ?>
    	<tr>
    		<td><?php echo $user['id'] ?></td>
    		<td><a href="/users/edit/<?php echo $user['id'] ?>"><?php echo $user['username'] ?></a></td>
    		<td><?php echo $user['first_name'] ?></td>
    		<td><?php echo $user['last_name'] ?></td>   
    		<td><?php echo $user['email'] ?></td>
    		<td>--</td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>User ID</th>
			<th>Username</th>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
			<th>Group</th>
		</tr>
	</tfoot>
</table>


</div><!--/span-->



