<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>Shot stage ID</th>
			<th>Shot stage</th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($shot_stages as $shot_stage): ?>
    	<tr>
    		<td><?php echo $shot_stage['shot_stage_id'] ?></td>
    		<td><a href="/users/edit/<?php echo $shot_stage['shot_stage_id'] ?>"><?php echo $shot_stage['shot_stage_name'] ?></a></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Shot stage ID</th>
			<th>Shot stage</th>
		</tr>
	</tfoot>
</table>

<a class="btn btn-large btn-block" href="/admin/shot_stages_create/">Add stage</a>
</div><!--/span-->



