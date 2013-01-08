<?php
session_start();

if(!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == null || $_SERVER['HTTP_REFERER'] == '') $_SERVER['HTTP_REFERER'] = "index.php";

if(empty($_GET['token']) || $_GET['token'] != $_SESSION['token'])
{
    header("location:".$_SERVER['HTTP_REFERER']);
} 

session_unset(); 
session_destroy();
header("location:".$_SERVER['HTTP_REFERER']);
?>