<?php $span_value = ($use_sidebar == TRUE ? "span9" : "span12"); ?>

<div class="<?php echo $span_value ?>">

<h2><?php echo $title ?></h2>

<script>


var make_status_dropdown = function(status) {
	
	// The following function generates a boostrap-style dropdown according
	// to the "status" input given. The content of the dropdown menu itself
	// can be loaded via further javascript, in order to reduce weight on 
	// the DOM.
	
	var btn_style = '';
	var label = '';
	
	if (status == "in_progress") {
		var btn_style = 'btn-warning';
		var label = 'In Progress';
	} else if (status == "todo") {
		var btn_style = '';
		var label = 'To do';
	} else if (status == "fix") {
		var btn_style = 'btn-error';
		var label = 'Error';
	} else if (status == "final_1") {
		var btn_style = 'btn-success';
		var label = 'Final 1';
	}  
	
	var markup = '<div class="btn-group dd_status">';
	var markup = markup + '<a class="btn btn-mini dropdown-toggle ' + btn_style + '" data-toggle="dropdown" href="#">';
	var markup = markup + label;
	var markup = markup + '<span class="caret"></span></a><ul class="dropdown-menu"></ul></div> ';

	return markup;
};

		
	$(document).ready(function() {
	    $('#shots').dataTable( {
	        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				$('td:eq(3)', nRow).html(make_status_dropdown(aData[3]));
			}
	    } );
	} );
</script>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="shots">
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
    		<td><?php echo $shot['shot_status_name']?></td>   
    			<!-- <div class="btn-group dd_status">
				    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
				    <?php echo $shot['shot_status_name'] ?>
				    <span class="caret"></span>
				    </a>
				    <ul class="dropdown-menu">
				    </ul>
			    </div> -->
		    
    		<td><?php echo $shot['shot_stage_name'] ?></td>
    		<td><?php echo $shot['shot_notes'] ?></td>
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



