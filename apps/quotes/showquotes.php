<?php #showquotes.php

include('./includes/dbc.php');
$q = "SELECT text FROM quotes ORDER BY RAND() LIMIT 1";
$ps = $pdo->prepare($q);
$ps->execute();
$quote = $ps->fetch(PDO::FETCH_NUM);

$this->cContent[] = "<p><textarea readonly> $quote[0] </textarea></p>";
$this->cContent[] = '<p><a href="showquotes.php"> Next </a></p>';

$this->cContent[] = '
<p><a href="index.php?page=addquote">Create a new quote!</p>
';

?>