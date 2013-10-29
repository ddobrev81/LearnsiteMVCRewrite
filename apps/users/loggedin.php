<?php #loggedin.php
session_start();

if(!isset($_SESSION['user_id'])) {
    $url = absolute_url();
    header("Location: $url");
    exit();
}


$content[] = '	<p>You are now logged in, '.$_SESSION['first_name'].'!</p>
		<p><a href="index.php?page=logout">Logout</a></p>
';
