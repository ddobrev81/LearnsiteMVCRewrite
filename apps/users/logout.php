<?php #logout.php

session_start();

if(!isset($_SESSION['user_id'])) {
    $url = absolute_url();
    header("Location: $url");
    exit();
} else {
    setcookie('first_name', '', time()-3600, '/', '', 0,0);
    $_SESSION = array();
    session_destroy();
    setcookie('PHPSESSID', '', time()-3600, '/','',0,0);
}
$this->cContent[] = "<p>You are now logged out!</p>";
