<?php

ini_set('session.cookie_secure', 1);
ini_set('session.cookie_httponly', 1);


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); 
}

if (!isset($_SESSION["login_counter"])) {
    $_SESSION["login_counter"] = 0;
}


?>