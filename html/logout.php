<?php 
//session_start(); 
include 'config.php';
// Destroy all sessions 
session_destroy(); 

// Redirect to login page 
header("Location: login.html"); 
exit; 
?>
