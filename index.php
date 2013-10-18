<?php #index.php
session_start();

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
//} else {
  //  $url = absolute_url();
    //header('HTTP/1.1 303 See Other');
    //header("Location: $url");
    //exit;
//}
?>