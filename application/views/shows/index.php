<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>


<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="users">
	<thead>
		<tr>
			<th>Show ID</th>
			<th>Show name</th>
			<th>Show description</th>
			<th>Show path</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		
	<?php foreach ($shows as $show): ?>
    	<tr <?php echo ($current_show['setting_value'] == $show['show_id'] ? "class=\"success\"" : ""); ?>>
    		<td><?php echo $show['show_id'] ?></td>
    		<td><a href="/shows/edit/<?php echo $show['show_id'] ?>"><?php echo $show['show_name'] ?></a></td>
    		<td><?php echo $show['show_description'] ?></td>
    		<td><?php echo $show['show_path'] ?></td>
    		<td></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Show ID</th>
			<th>Show name</th>
			<th>Show description</th>
			<th>Show path</th>
			<th></th>
		</tr>
	</tfoot>
</table>

<a class="btn btn-large btn-block" href="/shows/create">Add show</a>
</div><!--/span-->



