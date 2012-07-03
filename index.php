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
					<select id="dd_menu">
						<option value="all">View all</option>
						<option value="10">10</option>
						<option value="50">50</option>
						<option value="100">100</option>
					</select> 
						<table class="paginated">
							<thead>
								<tr>
									<th>Number</th>
									<th>Description</th>
									<th>Duration</th>
									<th>Status</th>
									<th>Notes</th>
									<th>Owner</th>
								</tr>
							</thead>
							<tbody>
							<?php
							include('db.php');
							$sql=mysql_query("select * from shots");
							while($row=mysql_fetch_array($sql)){
								$id=$row['id'];
								$number=$row['number'];
								$description=$row['description'];
								$duration=$row['duration'];
								$status=$row['status'];
								$status=$row['notes'];
								$status=$row['owner'];
								?>
								<tr id="<?php echo $id; ?>" class="edit_tr">
									<td class="edit_td">
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
									
									<td class="edit_td">
										<span id="status_<?php echo $id; ?>" class="status text"><?php echo $status; ?></span>
										<span class="status text"><?php echo $status; ?></span>
									</td>
									
									<td class="edit_td">
										<span id="notes_<?php echo $id; ?>" class="notes text"><?php echo $notes; ?></span>
										<span class="notes text"><?php echo $notes; ?></span>
									</td>
									
									<td class="edit_td">
										<span id="owner_<?php echo $id; ?>" class="owner text"><?php echo $owner; ?></span>
										<span class="owner text"><?php echo $owner; ?></span>
									</td>
								</tr>
							<?php }	?>
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
				<p>Code licensed under the <a target="_blank" href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a>.</p>
		      </footer>
		</div> <!-- container -->
	</body>
</html>