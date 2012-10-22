<?php
include("../db.php");
if($_POST['number']) {
	$scene_id = $_POST['scene'];
	$number = $_POST['number'];
	$description = $_POST['description'];
	$duration = $_POST['duration'];
	/*
	$data = array($scene_id, $number, $description, $duration);  
	$std = $dbh->("INSERT INTO shots (scene_id, number, description, duration) values (?, ?, ?, ?)");
	$sth->execute($data); 
	*/
	
	/*
	# the data we want to insert
	$data = array( 'scene_id' => 'Cathy', 'addr' => '9 Dark and Twisty', 'city' => 'Cardiff' );
	# the shortcut!
	$STH = $DBH->("INSERT INTO folks (name, addr, city) value (:name, :addr, :city)");
	$STH->execute($data);
	*/
	
	
	$query = "INSERT INTO shots (`id`, `scene_id`, `number`, `description`, `duration`, `status`, `stage`, `owner`) VALUES (NULL, '$scene_id', '$number', '$description', '$duration', 'todo', 'layout', 'none')";
	// Run the query on the dbh object
	$dbh->query($query);
	
	echo($query.' has ben run.');

	//echo("Query performed correctly. Added shot '".$number."' to the database.");
}
?>