<?php #addquote.php

session_start();


if(isset($_POST['submitted'])) {
	if(empty($_POST['quote'])) {
		$this->cContent[] = "You did not submit any quotes!\n";
	}else{
		$quote = trim($_POST['quote']);
	}
	if(empty($_SESSION['user_id'])) {
		$this->cContent[] = "<p>You are not logged in. Only logged in users can create quotes!</p><br>";
	}else{
		$user_id = $_SESSION['user_id'];
	}
	
	if(empty($this->cContent)) {
		include('./includes/dbc.php');
		$q = "INSERT INTO quotes (user_id, text, creation_date) VALUES (:uid, :t, NOW())";
		$ps = $pdo->prepare($q);
		$params = array('uid' => $user_id, 't' => $quote);
		$r = $ps->execute($params);
		if($r) {
			$this->cContent[] = '<p>Quote added to database, thx!<p><br>';
		}else{
			$this->cContent[] = '<h1>Ooops something went wrong!<br></h1>';
		}

	}
	
}

$this->cContent[] = '
<br>
<form action="index.php?page=addquote" method="post">
<textarea name="quote" placeholder="Insert your quote here, max 500 characters:" style="width:450px;height:150px;"></textarea></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />
';
