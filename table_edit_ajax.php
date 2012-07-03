<?php
include("db.php");
if($_POST['id']) {
	$id=mysql_escape_String($_POST['id']);
	$cell=mysql_escape_String($_POST['cell']);
	$value=mysql_escape_String($_POST['value']);
	$sql = "UPDATE shots SET ".$cell."='$value' WHERE id='$id'";
	mysql_query($sql);
	echo($sql);
}
?>