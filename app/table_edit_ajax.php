<?php
include("db.php");
if($_POST['id']) {
	$id = $_POST['id'];
	$cell = $_POST['cell'];
	$value = $_POST['value'];
	$sql = "UPDATE shots SET ".$cell."='$value' WHERE id='$id'";
	mysql_query($sql);
	echo("Query performed correctly.");
}
?>