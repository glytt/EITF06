<?php 
 
include 'config.php';

session_destroy(); 

header("Location: login.html"); 
exit; 
?>
