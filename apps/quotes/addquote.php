<?php #addquote.php

session_start();


if(isset($_POST['submitted'])) {
	if(empty($_POST['quote'])) {
		$content[] = "You did not submit any quotes!\n";
	}else{
		$quote = trim($_POST['quote']);
	}
	if(empty($_SESSION['user_id'])) {
		$content[] = "<p>You are not logged in. Only logged in users can create quotes!</p><br>";
	}else{
		$user_id = $_SESSION['user_id'];
	}
	
	if(empty($content)) {
		include('./includes/dbc.php');
		$q = "INSERT INTO quotes (user_id, text, creation_date) VALUES (:uid, :t, NOW())";
		$ps = $pdo->prepare($q);
		$params = array('uid' => $user_id, 't' => $quote);
		$r = $ps->execute($params);
		if($r) {
			$content[] = '<p>Quote added to database, thx!<p><br>';
		}else{
			$content[] = '<h1>Ooops something went wrong!<br></h1>';
		}

	}
	
}

$content[] = '
<br>
<form action="index.php?page=addquote" method="post">
<textarea name="quote" placeholder="Insert your quote here, max 500 characters:" style="width:450px;height:150px;"></textarea></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />
';
