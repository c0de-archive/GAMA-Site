<?php
//This is for all login requests to mysql
$host=""; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name=""; // Database name 
$tbl_name=""; // Table name 

// Connect to server and select database.
mysql_connect("$host", "$username", "$password")or die("Unable to connect to database server - check dbsettings.php"); 
mysql_select_db("$db_name")or die("Unable to connect to database - check dbsettings.php");
?>
