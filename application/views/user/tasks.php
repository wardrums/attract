<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($shots as $shot): ?>
    	<tr>
    		<td><?php echo $shot['shot_id'] ?></td>
    		<td><a href="/shots/view/<?php echo $shot['shot_id'] ?>"><?php echo $shot['shot_name'] ?></a></td>
    		<td><?php echo $shot['shot_description'] ?></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
		</tr>
	</tfoot>
</table>

</div><!--/span-->



