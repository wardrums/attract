<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>Sequence ID</th>
			<th>Sequence name</th>
			<th>Sequence description</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($sequences as $sequence): ?>
    	<tr>
    		<td><?php echo $sequence['sequence_id'] ?></td>
    		<td><a href="/sequences/edit/<?php echo $sequence['sequence_id'] ?>"><?php echo $sequence['sequence_name'] ?></a></td>
    		<td><?php echo $sequence['sequence_description'] ?></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Sequence ID</th>
			<th>Sequence name</th>
			<th>Sequence description</th>
		</tr>
	</tfoot>
</table>

<a class="btn btn-large btn-block" href="/sequences/create">Add sequence</a>
</div><!--/span-->



