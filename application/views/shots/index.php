<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<script>
	$(document).ready(function() {
	    $('#example').dataTable();
	} );
</script>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
			<th>Shot Name</th>
			<th>Description</th>
			<th>Duration</th>
			<th>Status</th>
			<th>Stage</th>
			<th>Notes</th>
			<th>Owners</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($shots as $shot): ?>
    	<tr>
    		<td><a href="/shots/view/<?php echo $shot['shot_id'] ?>"><?php echo $shot['shot_name'] ?></a></td>
    		<td><?php echo $shot['shot_description'] ?></td>
    		<td><?php echo $shot['shot_duration'] ?></td>
    		<td><?php echo $shot['shot_description'] ?></td>
    		<td><?php echo $shot['shot_description'] ?></td>
    		<td><?php echo $shot['shot_description'] ?></td>
    		<td><?php echo $shot['user_first_name']?></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Shot Name</th>
			<th>Description</th>
			<th>Duration</th>
			<th>Status</th>
			<th>Stage</th>
			<th>Notes</th>
			<th>Owners</th>
		</tr>
	</tfoot>
</table>


</div><!--/span-->



