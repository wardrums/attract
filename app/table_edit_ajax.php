<?php
include("db.php");
if($_POST['table']) {
	$table = $_POST['table'];
	$id = $_POST['id'];
	$cell = $_POST['cell'];
	$value = $_POST['value'];
	$query = "UPDATE $table SET ".$cell."='$value' WHERE id='$id'";
	
	// Run the query on the dbh object
	$dbh->query($query);

	echo("Query performed correctly.");
}
?>