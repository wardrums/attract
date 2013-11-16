<div class="row filtered-shots-tasks">
	<div class="col-md-12"> 
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped" id="shots">
			<thead>
				<tr>
					<th>Shot name</th>
					<th>Description</th>
					<th>Duration</th>
					<th>Notes</th>
				</tr>
			</thead>
			<tbody>
			<?php if (empty($shots)) : ?>
				<tr>
					<td colspan="4">There are no shots in this status</td>
				</tr>
			<?php endif ?>
			
			<?php foreach ($shots as $shot): ?>
		    	<tr id="row_<?php echo $shot['shot_id'] ?>">
		    		<td><a href="/shots/edit/<?php echo $shot['shot_id'] ?>"><?php echo $shot['shot_name'] ?></a></td>
		    		<td><?php echo $shot['shot_description'] ?></td>
		    		<td><?php echo $shot['shot_duration'] ?></td>
		    		<td><?php echo $shot['shot_notes'] ?></td>
		    	</tr>
			<?php endforeach ?>
				
			</tbody>
			<tfoot>
				<tr>
					<th>Shot name</th>
					<th>Description</th>
					<th>Duration</th>
					<th>Notes</th>
				</tr>
			</tfoot>
		</table>
	</div>	
</div><!--/span-->



