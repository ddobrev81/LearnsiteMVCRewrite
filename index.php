<?php #index.php
session_start();

include 'classes/classes.php';
include 'includes/stdlib.php';

if(isset($_GET['post'])) {
    $site = new csite();
    initialise_site($site);
    $page = new cpage($_GET['page']);
    $site->setPage($page);

    Controller::router($_GET['page']);

    $page->setContent($content);
    $site->render();
} else {
    $url = absolute_url();
    var_dump($url);
    header("Location: $url");
    exit;
}
?>