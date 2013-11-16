<?php $span_value = ($use_sidebar == TRUE ? "col-md-9" : "col-md-12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="users">
	<thead>
		<tr>
			<th>Status ID</th>
			<th>Status name</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($statuses as $status): ?>
    	<tr>
    		<td><?php echo $status['status_id'] ?></td>
    		<td><a href="/users/edit/<?php echo $status['status_id'] ?>"><?php echo $status['status_name'] ?></a></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Status ID</th>
			<th>Status name</th>
		</tr>
	</tfoot>
</table>

<a class="btn btn-default btn-lg btn-block" href="/statuses/create">Add status</a>
</div><!--/span-->



