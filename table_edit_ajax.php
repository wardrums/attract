<?php
include("db.php");
if($_POST['id']) {
	$id=mysql_escape_String($_POST['id']);
	$number=mysql_escape_String($_POST['number']);
	$description=mysql_escape_String($_POST['description']);
	$sql = "UPDATE shots SET number='$number',description='$description' WHERE id='$id'";
	mysql_query($sql);
}
?>