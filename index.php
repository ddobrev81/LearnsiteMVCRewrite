<?php #index.php
session_start();
error_reporting(E_ALL ^ E_NOTICE); 

include 'includes/config.php';
include 'includes/stdlib.php';

if(!isset($_GET['page'])) {
    $_GET['page'] = 'main';
}    
    
$site = new csite();
initialise_site($site);
$page = new cpage($_GET['page']);
$site->setPage($page);
// ..Im still working on it!
$content = Controller::router($_GET['page']);
$page->setContent($content);
$site->render();

?>
