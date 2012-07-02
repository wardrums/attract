<?php
include("db.php");
if($_POST['id']) {
	$id=mysql_escape_String($_POST['id']);
	$shot_number=mysql_escape_String($_POST['shot_number']);
	$shot_status=mysql_escape_String($_POST['shot_status']);
	$sql = "UPDATE shots SET shot_number='$shot_number',shot_status='$shot_status' WHERE id='$id'";
	mysql_query($sql);
}
?>