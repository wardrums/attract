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
		var btn_style = 'btn-danger';
		var label = 'Fix';
	} else if (status == "final_1") {
		var btn_style = 'btn-success';
		var label = 'Final 1';
	} else if (status == "review") {
		var btn_style = '';
		var label = 'Review';
	} 
	
	var markup = '<div class="btn-group btn-group-cell">';
	var markup = markup + '<a class="btn btn-mini dropdown-toggle dropdown-status ' + btn_style + '" data-toggle="dropdown" href="#">';
	var markup = markup + label;
	var markup = markup + '<span class="caret"></span></a><ul class="dropdown-menu dropdown-menu-statuses"></ul></div> ';

	return markup;
};

// here whe have some code generated with PHP, maybe not very elegant but it works

var s = '';
<?php foreach ($shot_statuses as $shot_status): ?>
s = s + '<li><a href="#" status_id="<?php echo $shot_status['shot_status_id'] ?>" status_label="<?php echo $shot_status['shot_status_name'] ?>"><?php echo $shot_status['shot_status_name'] ?></a></li>';
<?php endforeach ?>
var statuses_list = s;

var make_stages_dropdown = function(status) {
	
	// The following function generates a boostrap-style dropdown according
	// to the "status" input given. The content of the dropdown menu itself
	// can be loaded via further javascript, in order to reduce weight on 
	// the DOM.
	
	var label = '';
	
	if (status == "boards") {
		var label = 'Boards';
	} else if (status == "layout") {
		var label = 'Layout';
	} else if (status == "animatic") {
		var label = 'Animatic';
	} else if (status == "lighting") {
		var label = 'Lighting';
	} else if (status == "animation") {
		var label = 'Animation';
	} else if (status == "simulation") {
		var label = 'Simulation';
	}     
	
	var markup = '<div class="btn-group btn-group-cell">';
	var markup = markup + '<a class="btn btn-mini dropdown-toggle dropdown-stage" data-toggle="dropdown" href="#">';
	var markup = markup + label;
	var markup = markup + '<span class="caret"></span></a><ul class="dropdown-menu dropdown-menu-stages"></ul></div> ';

	return markup;
};

// here whe have some code generated with PHP, maybe not very elegant but it works

var s = '';
<?php foreach ($tasks as $shot_stage): ?>
s = s + '<li><a href="#" stage_id="<?php echo $shot_stage['shot_stage_id'] ?>" stage_label="<?php echo $shot_stage['shot_stage_name'] ?>"><?php echo $shot_stage['shot_stage_name'] ?></a></li>';
<?php endforeach ?>
var stages_list = s;


// DataTables functionality (we inizialize the table and call it shotsTable)
// then we replace the content of the 3rd and 4th column with some js generated code

$(document).ready(function() {
    var shotsTable = $('#shots').dataTable( {
    	"iDisplayLength": 50,
		"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
			$('td:eq(3)', nRow).html(make_status_dropdown(aData[3]));
			$('td:eq(4)', nRow).html(make_stages_dropdown(aData[4]));
		}
    });
    
    // the next two functions populate dynamically the content of the dropdown menu
    // with two different lists build previously
    
    $(document).on("click", ".dropdown-status", function() {
		if(!$(this).hasClass('open')) {
       		$(this).next().html(statuses_list);
    	}
	});
	
	$(document).on("click", ".dropdown-stage", function() {
		if(!$(this).hasClass('open')) {
       		$(this).next().html(stages_list);
    	}
	});
	
	// this are the functions that actually set the new values in the database
	// and update the table structure
	
	$(document).on("click", ".dropdown-menu-statuses a", function() {
		var status_id = $(this).attr('status_id');
		var status_label = $(this).attr('status_label');
		var tableRow = $(this).parents("tr");
		var rowPosition = shotsTable.fnGetPosition(tableRow[0]);
		var shotID = tableRow.attr("id").split("_")[1];
		
		shotsTable.fnUpdate(status_label, rowPosition ,3);
		query = '/shots/edit_single/' + shotID + '/status_id/' + status_id;
		$.getJSON(query, function() {
			console.log('Shot status updated');	
		});
		
	});
	
	$(document).on("click", ".dropdown-menu-stages a", function() {
		var stage_id = $(this).attr('stage_id');
		var stage_label = $(this).attr('stage_label');
		var tableRow = $(this).parents("tr");
		var rowPosition = shotsTable.fnGetPosition(tableRow[0]);
		var shotID = tableRow.attr("id").split("_")[1];
		
		shotsTable.fnUpdate(stage_label, rowPosition ,4);
		query = '/shots/edit_single/' + shotID + '/stage_id/' + stage_id;
		$.getJSON(query, function() {
			console.log('Shot status updated');
		});
		
	});
	
	
	
	$(document).on("click", ".load-users", function() {
		var tableRow = $(this).parents("tr");
		var rowPosition = shotsTable.fnGetPosition(tableRow[0]);
		var shotID = tableRow.attr("id").split("_")[1];
		
		$('td').removeClass('target');
		
		$(this).parents('td').addClass('target');
		$.get('/shots/get_users_selector/' + shotID, function(data) {
			$('.target').html(data);
			$('.target').append('<a class="btn btn-mini btn-primary assign-users">Assign</a><a class="btn btn-mini cancel-assign-users">Cancel</a>');
		});
		
	});
	
	$(document).on("click", ".assign-users", function() {
		var tableRow = $(this).parents("tr");
		var rowPosition = shotsTable.fnGetPosition(tableRow[0]);
		var shotID = tableRow.attr("id").split("_")[1];
		
		var selectedValues = $(this).prev().val();
		console.log(selectedValues);
		$.post("/shots/assign_users/" + shotID, { 'shot_owners[]': selectedValues });
		$(this).prev().hide();
		/*
		$(this).parents('td').addClass('target');
		$.get('/shots/get_users_selector/' + shotID, function(data) {
			$('.target').html(data);
			$('.target').append('<a class="btn btn-mini btn-primary">Assign</a><a class="btn btn-mini">Cancel</a>');
		});
		*/
		
	});
	
	$(document).on("click", ".cancel-assign-users", function() {
		console.log($(this).parent().children().hide());
	});
	

	

});



</script>

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="shots">
	<thead>
		<tr>
			<th>Shot Name</th>
			<th>Description</th>
			<th>Duration</th>
			<th>Status</th>
			<th>Tasks</th>
			<th>Notes</th>
			<th>Owners</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($shots as $shot): ?>
    	<tr id="row_<?php echo $shot['shot_id'] ?>">
    		<td><a href="/shots/edit/<?php echo $shot['shot_id'] ?>"><?php echo $shot['shot_name'] ?></a></td>
    		<td><?php echo $shot['shot_description'] ?></td>
    		<td><?php echo $shot['shot_duration'] ?></td>
    		<td><?php echo $shot['status_name']?></td>   
    			<!-- <div class="btn-group dd_status">
				    <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
				    <?php echo $shot['shot_status_name'] ?>
				    <span class="caret"></span>
				    </a>
				    <ul class="dropdown-menu">
				    </ul>
			    </div> -->
		    
    		<td><?php echo $shot['shot_task_id'] ?></td>
    		<td><?php echo $shot['shot_notes'] ?></td>
    		<td><?php echo $shot['user_id']?> <a class="btn btn-mini load-users" href="#">Assign...</a></td>
    	</tr>
	<?php endforeach ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Shot Name</th>
			<th>Description</th>
			<th>Duration</th>
			<th>Status</th>
			<th>Tasks</th>
			<th>Notes</th>
			<th>Owners</th>
		</tr>
	</tfoot>
</table>


</div><!--/span-->



