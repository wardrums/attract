<?php
include("../db.php");
if($_POST['username']) {
	$username = $_POST['username'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$query = "INSERT INTO `users` (`id`, `username`, `name`, `surname`) VALUES (NULL, '$username', '$name', '$surname')";
	// Run the query on the dbh object
	$dbh->query($query);

	echo("Query performed correctly. Added user '".$username."' to the database.");
}
?>