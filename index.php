<?php #index.php
session_start();
error_reporting(E_ALL ^ E_NOTICE); 

include 'classes/classes.php';
include 'includes/stdlib.php';

if(!isset($_GET['page'])) {
    $_GET['page'] = 'main';
}    
    
    $site = new csite();
    initialise_site($site);
    $page = new cpage($_GET['page']);
    $site->setPage($page);

    $content = Controller::router($_GET['page']);
    $page->setContent($content);
    $site->render();

?>