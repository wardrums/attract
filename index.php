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
									<th>Name</th>
									<th>Status</th>
									<th>Duraion</th>
								</tr>
							</thead>
							<tbody>
							<?php
							include('db.php');
							$sql=mysql_query("select * from shots");
							while($row=mysql_fetch_array($sql)){
								$id=$row['id'];
								$shot_number=$row['shot_number'];
								$shot_desc=$row['shot_desc'];
								$shot_duration=$row['shot_duration'];
								?>
								<tr id="<?php echo $id; ?>" class="edit_tr">
									<td class="edit_td">
										<span id="first_<?php echo $id; ?>" class="text"><?php echo $shot_number; ?></span>
										<input type="text" value="<?php echo $shot_number; ?>" class="editbox" id="first_input_<?php echo $id; ?>" />
									</td>
									
									<td class="edit_td">
										<span id="last_<?php echo $id; ?>" class="text"><?php echo $shot_desc; ?></span>
										<input type="text" value="<?php echo $shot_desc; ?>" class="editbox" id="last_input_<?php echo $id; ?>"/>
									</td>
									
									<td class="edit_td">
										<span class="text"><?php echo $shot_duration; ?></span>
									</td>
								</tr>
							<?php }	?>
							</tbody>
						</table>
						<span class="prev">Previous</span><span class="next">Next</span>
					</div>
				</div>
			</section>
		</div> <!-- container -->
		
		
		<script src="assets/js/jquery-1.7.2.min.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<script src="assets/js/jquery.metadata.js"></script>
		<script src="assets/js/jquery.tablesorter.min.js"></script>
		<script src="assets/js/jquery.tablecloth.js"></script>
		<script type="text/javascript" src="attract.js"></script>
	</body>
</html>