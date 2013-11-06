<?php #index.php
session_start();
error_reporting(E_ALL ^ E_NOTICE); 

include 'includes/stdlib.php';

if(!isset($_GET['page'])) {
    $_GET['page'] = 'main';
}    
    
$site = new csite();
initialise_site($site);
$page = new cpage($_GET['page']);
$site->setPage($page);
$controller = new Controller($_GET['page']);
$content = $controller->getContent();
$page->setContent($content);
$site->render();