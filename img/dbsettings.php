<?php
//This is for all login requests to mysql
$host="localhost"; // Host name 
$username=""; // Mysql username 
$password=""; // Mysql password 
$db_name=""; // Database name 
$tbl_name=""; // Table name 

// Connect to server and select database.
$db = new mysqli($host, $username, $password, $db_name);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . '] - Check dbsettings.php');
}
?>
