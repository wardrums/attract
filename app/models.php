<?php

# Queries for the stats of steel (requires db.php to work standalone)
# Uncomment for debugging purposes
# include 'db.php';

$result = $dbh->query('SELECT SUM(duration) AS value_sum FROM shots'); 
$row = $result->fetch(PDO::FETCH_ASSOC); 
$result = $dbh->query('SELECT * FROM shots');
$num_total = $result->rowCount();
$sum_total = $row['value_sum'];

$result = $dbh->query("SELECT SUM(duration) AS value_sum FROM shots WHERE status='in_progress'"); 
$row = $result->fetch(PDO::FETCH_ASSOC);
$result = $dbh->query("SELECT * FROM shots WHERE status='in_progress'");
$num_in_progress = $result->rowCount();
$sum_in_progress = $row['value_sum'];

$result = $dbh->query("SELECT SUM(duration) AS value_sum FROM shots WHERE status='final1'"); 
$row = $result->fetch(PDO::FETCH_ASSOC);
$result = $dbh->query("SELECT * FROM shots WHERE status='final1'"); 
$num_final1 = $result->rowCount();
$sum_final1 = $row['value_sum'];

$result = $dbh->query("SELECT SUM(duration) AS value_sum FROM shots WHERE status='fix'"); 
$row = $result->fetch(PDO::FETCH_ASSOC); 
$result = $dbh->query("SELECT * FROM shots WHERE status='fix'");
$num_fix = $result->rowCount();
$sum_fix = $row['value_sum'];


# Get owners? If I query database here, how can I make the data accessible in the other page?
# It does not seem to work at the moment
# $result = $dbh->query("SELECT * FROM users"); 


$users_query_result = $dbh->query("SELECT * FROM users");


?>