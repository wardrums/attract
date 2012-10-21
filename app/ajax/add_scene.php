<?php
include("../db.php");
if($_POST['number']) {
	$number = $_POST['number'];
	$description = $_POST['description'];
	$query = "INSERT INTO `scenes` (`id`, `number`, `description`) VALUES (NULL, '$number', '$description')";
	// Run the query on the dbh object
	$dbh->query($query);

	echo("Query performed correctly. Added shot '".$number."' to the database.");
}
?>