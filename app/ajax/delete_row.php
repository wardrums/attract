<?php
include("../db.php");
if($_POST['id']) {
	$id = $_POST['id'];
	$table = $_POST['table'];
	$query = "DELETE FROM $table WHERE id IN ($id)";
	// Run the query on the dbh object
	$dbh->query($query);

	echo("Query performed correctly. Deleted row from the database.");
}
?>