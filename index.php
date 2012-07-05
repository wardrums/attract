<!DOCTYPE html>  
<html lang="en">  
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Attract - TOS</title>		
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="assets/css/tablecloth.css" rel="stylesheet">
		<link href="assets/css/prettify.css" rel="stylesheet"> 
		<link href="assets/css/attract.css" rel="stylesheet">
		<link rel="shortcut icon" href="assets/favicon/favicon.ico" type="image/x-icon" /> 
		
		<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/js/jquery.metadata.js"></script>
		<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.tablecloth.js"></script>
		<script type="text/javascript" src="assets/js/attract.js"></script>
		
	</head>
	<body>
		<div class="container">
			<section>
				<div class="page-header">
					<h1>Render tracking of steel <small>where we keep track of the tears</small></h1>
				</div>
				<div class="row">
					<div class="span12">
					<select id="status">
						<option value="any">View all</option>
						<option value="todo">TODO</option>
						<option value="fix">Fix</option>
						<option value="in_progress">In progress </option>
						<option value="rendering">Rendering</option>
						<option value="review">Review</option>
						<option value="final1">Final 1</option>
					</select>
					<div class="btn-toolbar">
						<div class="btn-group">
						    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						    Action
						    <span class="caret"></span>
						    </a>
						    <ul class="dropdown-menu">
						    <!-- dropdown menu links -->
						    </ul>
						</div>
						<div class="btn-group"><a class="btn prev" href="">Reset</a> </div>
						
					</div>
					
					
						<table class="paginated">
							<thead>
								<tr>
									<th class="{sorter: false}" width="80px">Number</th>
									<th class="{sorter: false}">Description</th>
									<th class="{sorter: false}">Duration</th>
									<th class="{sorter: false}" width="100px">Status</th>
									<th class="{sorter: false}">Notes</th>
									<th class="{sorter: false}" width="100px">Owner</th>
								</tr>
							</thead>
							<?php
							include('db.php');
							$sql_scenes = mysql_query("SELECT * FROM scenes");
							
							while($scene_row = mysql_fetch_array($sql_scenes)){
								$scene_id = $scene_row['id'];
								$scene_number = $scene_row['number'];
								$scene_description = $scene_row['description']; ?>
								<thead>
									<tr>
										<th class="{sorter: false}" colspan="6"><?php echo($scene_number." ".strtoupper($scene_description)); ?></th>
									</tr>
								</thead>
								<?php					
								$shot_query = sprintf("SELECT * FROM shots WHERE scene_id='%s'",
								mysql_real_escape_string($scene_id));
								
								$shot_query_result = mysql_query($shot_query);
								
								if (!$shot_query_result) {
								    $message  = 'Invalid query: ' . mysql_error() . "\n";
								    $message .= 'Whole query: ' . $query;
								    die($message);
								}
								
								while($shot_row = mysql_fetch_array($shot_query_result)){
									$id = $shot_row['id'];
									$number = $shot_row['number'];
									$description = $shot_row['description'];
									$duration = $shot_row['duration'];
									$status = $shot_row['status'];
									$notes = $shot_row['notes'];
									$owner = $shot_row['owner'];
								?>
							<tbody>
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
										<input type="text" value="<?php echo $duration; ?>" class="editbox" id="duration_input_<?php echo $id; ?>"/>
									</td>
									
									<td class="edit_td <?php echo $status; ?>">
										<span id="status_<?php echo $id; ?>" class="status text"><?php echo $status; ?></span>
										<select class="editbox" id="status_input_<?php echo $id; ?>">
											<option value="todo">TODO</option>
											<option value="fix">Fix</option>
											<option value="in_progress">In progress </option>
											<option value="rendering">Rendering</option>
											<option value="review">Review</option>
											<option value="final1">Final 1</option>
										</select> 
									</td>
									
									<td class="edit_td">
										<span id="notes_<?php echo $id; ?>" class="notes text"><?php echo $notes; ?></span>
										<input type="text" value="<?php echo $notes; ?>" class="editbox" id="notes_input_<?php echo $id; ?>"/>
									</td>
									
									<td class="edit_td">
										<span id="owner_<?php echo $id; ?>" class="owner text"><?php echo $owner; ?></span>
										<select class="editbox" id="owner_input_<?php echo $id; ?>">
											<option value="andy">Andy</option>
											<option value="francesco">Francesco</option>
											<option value="ian">Ian</option>
											<option value="jeremy">Jeremy</option>
											<option value="kjartan">Kjartan</option>
											<option value="roman">Roman</option>
											<option value="sebastian">Sebastian</option>
										</select>
									</td>
								</tr>
								<?php }
								}	?>
							</tbody>
						</table>
						<a class="btn prev" href="">Previous</a>
						<a class="btn next" href="">Next</a>
					</div>
				</div>
			</section>
			<footer class="footer">
				<p class="pull-right"><a href="#">Back to top</a></p>
				<p>Attract designed by <a target="_blank" href="http://www.fsiddi.com">fsiddi</a> build with <a target="_blank" href="#">bootstrap</a> and <a target="_blank" href="#">others</a>.</p>
				<p>Code available at <a target="_blank" href="https://github.com/fsiddi/attract">GitHub</a>.</p>
		      </footer>
		</div> <!-- container -->
	</body>
</html>