<?php
include("db.php");
if($_POST['id']) {
	$id = $_POST['id'];
	$cell = $_POST['cell'];
	$value = $_POST['value'];
	$query = "UPDATE shots SET ".$cell."='$value' WHERE id='$id'";
	
	// Run the query on the dbh object
	$dbh->query($query);

	echo("Query performed correctly.");
}
?>