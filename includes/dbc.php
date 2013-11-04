<?php #dbc.php
global $site_config;

$dbc = "mysql:host=" . $site_config['db']['host'] . ";dbname=" . $site_config['db']['database'];
$login= $site_config['db']['user'];
$password=$site_config['db']['password'];

$opt = array(
    // any occurring errors wil be thrown as PDOException
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // an SQL command to execute when connecting
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
);

$pdo = new PDO($dbc, $login, $password, $opt);
?>
