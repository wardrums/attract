<?php
include("db.php");
if($_POST['status'] || $_POST['owner']) {
	$statuses = $_POST['status'];
	$owners = $_POST['owner'];
	$statuses_list_for_query = "'" . str_replace(",", "','", $statuses) . "'";	
	$owners_list_for_query = "'" . str_replace(",", "','", $owners) . "'";
	
	if($statuses == "any") {
		if ($owners == "any") {
			$shot_query = sprintf("SELECT * FROM shots");
		} else {
			$shot_query = sprintf("SELECT * FROM shots WHERE owner IN (%s)",
			$owners_list_for_query);
		}
		
	} else {
		if ($owners == "any") {
			$shot_query = sprintf("SELECT * FROM shots WHERE status IN (%s)",
			$statuses_list_for_query);
		} else {
			$shot_query = sprintf("SELECT * FROM shots WHERE status IN (%s) AND owner IN (%s)",
			$statuses_list_for_query,
			$owners_list_for_query);
		}
	}
				
	$shot_query_result = mysql_query($shot_query);
	
	
	if (!$shot_query_result) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $query;
	    die($message);
	} ?>
	
	
	<thead>
		<tr>
			<th width="80px">Number</th>
			<th>Description</th>
			<th>Duration</th>
			<th width="100px">Status</th>
			<th width="100px">Stage</th>
			<th>Notes</th>
			<th width="100px">owner</th>
		</tr>
	</thead>
	
	
	<?php
	
	
	while($shot_row = mysql_fetch_array($shot_query_result)){
		$id = $shot_row['id'];
		$number = $shot_row['number'];
		$description = $shot_row['description'];
		$duration = $shot_row['duration'];
		$status = $shot_row['status'];
		$status = $shot_row['stage'];
		$notes = $shot_row['notes'];
		$owner = $shot_row['owner'];	
		
		//echo("<p>Query performed correctly.</p>");
		?>
		
		<tr id="<?php echo $id; ?>" class="edit_tr">
			<td>
				<span id="number_<?php echo $id; ?>" class="number text"><?php echo $number; ?></span>
				<input type="text" value="<?php echo $number; ?>" class="editbox" id="number_input_<?php echo $id; ?>" />
			</td>
			
			<td class="edit_td">
				<span id="description_<?php echo $id; ?>" class="description text"><?php echo $description; ?></span>
				<input type="text" value="<?php echo $description; ?>" class="editbox" id="description_input_<?php echo $id; ?>"/>
			</td>
			
			<td class="edit_td">
				<span id="duration_<?php echo $id; ?>" class="duration text"><?php echo $duration; ?></span>
				<input type="text" value="<?php echo $duration; ?>" class="duration editbox" id="duration_input_<?php echo $id; ?>"/>
			</td>
			
			<td>
				<div class="status btn-group">
				    <a class="btn dropdown-toggle btn-mini btn-<?php echo $status; ?>" data-toggle="dropdown" href="#">
				    <?php
				    	echo ucfirst($status); 
				    ?>
				    <span class="caret"></span>
				    </a>
				    <ul class="dropdown-menu">
					    <li><a href="#todo">TODO</a></li>
						<li><a href="#fix">Fix</a></li>
						<li><a href="#in_progress">In progress</a></li>
						<li><a href="#rendering">Rendering</a></li>
						<li><a href="#review">Review</a></li>
						<li><a href="#final1">Final 1</a></li>
				    </ul>
				</div>
			</td>
			
			<td class="edit_td">
				<span id="stage_<?php echo $stage; ?>" class="stage text"><?php echo $stage; ?></span>
			</td>
			
			<td class="edit_td">
				<span id="notes_<?php echo $id; ?>" class="notes text"><?php echo $notes; ?></span>
				<input type="text" value="<?php echo $notes; ?>" class="editbox" id="notes_input_<?php echo $id; ?>"/>
			</td>
			
			<td class="edit_td">
				<span id="owner_<?php echo $id; ?>" class="owner text"><?php echo $owner; ?></span>
				<input type="text" value="<?php echo $owner; ?>" class="editbox" id="owner_input_<?php echo $id; ?>"/>
			</td>
		</tr>

		
		<?
	}
}
?>