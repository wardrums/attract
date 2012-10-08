<!DOCTYPE html>  
<html lang="en">  
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Attract</title>		
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="assets/css/tablecloth.css" rel="stylesheet">
		<link href="assets/css/prettify.css" rel="stylesheet"> 
		<link href="assets/css/chosen.css" rel="stylesheet">
		<link href="assets/css/attract.css" rel="stylesheet">
		<link type="image/x-icon" href="assets/favicon/favicon.ico" rel="shortcut icon">
		<link rel="apple-touch-icon" href="assets/favicon/apple-touch-icon-57x57-precomposed.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-touch-icon-72x72-precomposed.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-touch-icon-114x114-precomposed.png" />

		
		<script type="text/javascript" src="assets/js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/js/jquery.metadata.js"></script>
		<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery.tablecloth.js"></script>
		<script type="text/javascript" src="assets/js/jquery.chosen.min.js"></script>
		<script type="text/javascript" src="assets/js/attract.js"></script>
		
	</head>
	<body>
		<?php
		if ((include 'app/db.php') !== 1) {
		    die('<div class="container"><section><div class="page-header"><h1>Could not locate database <small>Make sure that the app/dp.php file exists!</small></h1></div></section></div>
	</body>');
		}
		?>
		<div class="container">
		
			<div class="modal hide" id="statsModal">
		    	<div class="modal-header">
		    		<h3>Stats of steel</h3>
		    	</div>
			    <div class="modal-body">
			    	<?php
						$result = mysql_query('SELECT SUM(duration) AS value_sum FROM shots'); 
						$row = mysql_fetch_assoc($result); 
						$result = mysql_query('SELECT * FROM shots');
						$num_total = mysql_num_rows($result);
						$sum_total = $row['value_sum'];
						
						$result = mysql_query("SELECT SUM(duration) AS value_sum FROM shots WHERE status='in_progress'"); 
						$row = mysql_fetch_assoc($result);
						$result = mysql_query("SELECT * FROM shots WHERE status='in_progress'");
						$num_in_progress = mysql_num_rows($result);
						$sum_in_progress = $row['value_sum'];
						
						$result = mysql_query("SELECT SUM(duration) AS value_sum FROM shots WHERE status='final1'"); 
						$row = mysql_fetch_assoc($result);
						$result = mysql_query("SELECT * FROM shots WHERE status='final1'"); 
						$num_final1 = mysql_num_rows($result);
						$sum_final1 = $row['value_sum'];
						
						$result = mysql_query("SELECT SUM(duration) AS value_sum FROM shots WHERE status='fix'"); 
						$row = mysql_fetch_assoc($result); 
						$result = mysql_query("SELECT * FROM shots WHERE status='fix'");
						$num_fix = mysql_num_rows($result);
						$sum_fix = $row['value_sum'];
					?>
					<table id="stats">
						<thead>
							<tr>
								<th>Status</th>
								<th>Number of shots</th>
								<th>Seconds</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Total</td>
								<td><?php echo($num_total); ?></td>
								<td><?php echo($sum_total); ?> sec</td>
							</tr>
							<tr>
								<td>In progress</td>
								<td><?php echo($num_in_progress); ?></td>
								<td><?php echo($sum_in_progress); ?> sec</td>
							</tr>
							<tr>
								<td>Final</td>
								<td><?php echo($num_final1); ?></td>
								<td><?php echo($sum_final1); ?> sec</td>
							</tr>
						</tbody>
					</table>
	
			    </div>
			    <div class="modal-footer">
				    <a href="#" class="btn" data-dismiss="modal">Close</a>
				</div>
		    </div>

		
		
			<section>
				<div class="page-header">
					<h1>Attract <small>task tracking of steel</small></h1>
				</div>
				<div class="row">
					<div class="span6">
						<div id="querymachine">
							<select id="status" data-placeholder="Select status" style="width:250px;" multiple="multiple" class="chzn-select">
								<option value="any">View all</option>
								<option value="todo">To do</option>
								<option value="fix">Fix</option>
								<option value="in_progress">In progress </option>
								<option value="rendering">Rendering</option>
								<option value="review">Review</option>
								<option value="final1">Final 1</option>
							</select>
							<select id="owner" data-placeholder="Select owner" style="width:250px;" multiple="multiple" class="chzn-select">
								<option value="andy">Andy</option>
								<option value="francesco">Francesco</option>
								<option value="ian">Ian</option>
								<option value="jeremy">Jeremy</option>
								<option value="kjartan">Kjartan</option>
								<option value="rob">Rob</option>
								<option value="roman">Roman</option>
								<option value="sebastian">Sebastian</option>
								<option value="none">None</option>
							</select>
						</div>
						<div class="btn-toolbar">
							<div class="btn-group"><a class="btn prev" href="">Reset</a> </div>
							<div class="btn-group"><a class="btn" data-toggle="modal" href="#statsModal">Stats of steel</a></div>					
							
						</div>
					</div>
					<div class="span6">
						<?php 
							//we count seconds and NOT shots
							$total_percent = $sum_total/100;
							$in_total_and_final = intval(($sum_in_progress + $sum_final1) / $total_percent);
							$only_final = ($sum_final1) / $total_percent;
						?>
						<h3>Almost final seconds of the movie: <?php echo(($sum_in_progress + $sum_final1)."/".$sum_total)?></h3>
						<p>We are working on <?php echo($num_total); ?> shots in total!</p>
						<div class="progress progress-striped">
						    <div class="bar" style="width: <?php echo($in_total_and_final); ?>%;"></div>
						</div>
											
					</div>
				</div>
				<div class="row">
					<div class="span12">

						<table id="shotlist" class="paginated">
							<thead>
								<tr>
									<th class="{sorter: false}" width="80px">Number</th>
									<th class="{sorter: false}">Description</th>
									<th class="{sorter: false}">Duration</th>
									<th class="{sorter: false}" width="100px">Status</th>
									<th class="{sorter: false}" width="100px">Stage</th>
									<th class="{sorter: false}" width="35%">Notes</th>
									<th class="{sorter: false}" width="100px">Owner</th>
								</tr>
							</thead>
							<?php
									
							$sql_scenes = mysql_query("SELECT * FROM scenes");
							
							
							while($scene_row = mysql_fetch_array($sql_scenes)){
								$scene_id = $scene_row['id'];
								$scene_number = $scene_row['number'];
								$scene_description = $scene_row['description']; ?>
								<thead>
									<tr>
										<th class="{sorter: false}" colspan="7"><?php echo($scene_number." ".strtoupper($scene_description)); ?></th>
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
									$stage = $shot_row['stage'];
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
									
									<td>
										<div class="stage btn-group" <?php if($status != "in_progress") {echo("style =\"display: none;\"");} ?>>
										    <a class="btn dropdown-toggle btn-mini btn-<?php echo $stage; ?>" data-toggle="dropdown" href="#">
										    <?php
										    	echo ucfirst($stage); 
										    ?>
										    <span class="caret"></span>
										    </a>
										    <ul class="dropdown-menu">
											    <li><a href="#tracking">Tracking</a></li>
												<li><a href="#masking">Masking</a></li>
												<li><a href="#layout">Layout</a></li>
												<li><a href="#animation">Animation</a></li>
												<li><a href="#lighting">Lighting</a></li>
												<li><a href="#compositing">Compositing</a></li>
										    </ul>
										</div>
									</td>
									
									<td class="edit_td">
										<span id="notes_<?php echo $id; ?>" class="notes text"><?php echo $notes; ?></span>
										<input type="text" value="<?php echo $notes; ?>" class="editbox" id="notes_input_<?php echo $id; ?>"/>
									</td>
									
									<td>								
										<div class="owner btn-group">
										    <a class="btn dropdown-toggle btn-mini btn-<?php echo $owner; ?>" data-toggle="dropdown" href="#">
										    <?php
										    	echo ucfirst($owner); 
										    ?>
										    <span class="caret"></span>
										    </a>
										    <ul class="dropdown-menu">
											    <li><a href="#andy">Andy</a></li>
												<li><a href="#francesco">Francesco</a></li>
												<li><a href="#ian">Ian</a></li>
												<li><a href="#jeremy">Jeremy</a></li>
												<li><a href="#kjartan">Kjartan</a></li>
												<li><a href="#rob">Rob</a></li>
												<li><a href="#roman">Roman</a></li>
												<li><a href="#sebastian">Sebastian</a></li>
												<li><a href="#none">None</a></li>
										    </ul>
										</div>
										
										 
									
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