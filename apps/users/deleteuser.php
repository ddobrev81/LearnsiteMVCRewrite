<?php #delete_user.php

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id=$_GET['id'];
} elseif(($_POST['id']) && is_numeric($_POST['id'])) {
    $id=$_POST['id'];
} else {
    $this->cContent[] = '<p class="error">This page has been accessed in error.</p>';
    exit();
}

require_once('./includes/dbc.php');
if(isset($_POST['submitted']))	{
    if($_POST['sure'] == 'Yes')	{
        $q = "DELETE FROM users WHERE user_id=:id LIMIT 1";
	$ps = $pdo->prepare($q);
	$params = array('id' =>$id);
	$ps->execute($params);
	if($ps->rowCount() == 1) {
            $this->cContent[] = '<p>The user has been deleted!</p>';
	} else {
            $this->cContent[] =  '<p class="error">The user could not be deleted due to a system error.</p>';
	}
    } else {
        $this->cContent[] =  '<p>The user has NOT been deleted.</p>';
    }
} else {
    $q = "SELECT CONCAT(last_name, ' ,', first_name) FROM users WHERE user_id=:id";
    $ps = $pdo->prepare($q);
    $params = array('id' =>$id);
    $ps->execute($params);
    if($ps->rowCount() == 1) {
	$row = $ps->fetch(PDO::FETCH_NUM);
	$this->cContent[] = '
			<form action="index.php?page=deleteuser" method="post">
			<h3>Name: '.$row[0].'</h3>
			<p>Are you sure you want to delete this user?<br />
			<input type="radio" name="sure" value="Yes" /> Yes
			<input type="radio" name="sure" value="No" checked="checked" /> No</p>
			<p><input type="submit" name="submit" value="Submit" /></p>
			<input type="hidden" name="submitted" value="TRUE" />
			<input type="hidden" name="id" value="'. $id . '" />
			</form>
			';
    } else {
        $this->cContent[] = '<p class="error">This page has been accessed in error.</p>';
    }
}
