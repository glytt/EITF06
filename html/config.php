<?php

session_start();

// Generate a CSRF token and store it in the session
if (!isset($_SESSION['csrf_token'])) {
    echo "test";
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
    echo "CSRF token generated: " . $_SESSION['csrf_token']; 
}

?>