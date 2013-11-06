<?php #edit_user.php

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id=$_GET['id'];
} elseif(($_POST['id']) && is_numeric($_POST['id'])) {
    $id=$_POST['id'];
} else {
    $cContent[] = '<p class="error">This page has been accessed in error.</p>';
    exit();
}
require_once('./includes/dbc.php');
if(isset($_POST['submitted'])){
    if(empty($_POST['first_name']))	{
        $cContent[] = 'Enter your first name!';
    } else {
        $fn = trim($_POST['first_name']);
    }
    if(empty($_POST['last_name']))	{
        $cContent[] = 'Enter your last name!';
    } else {
        $ln = trim($_POST['last_name']);
    }
    if(empty($_POST['email'])) {
        $cContent[] = 'Enter your email!';
    } else {
        $e = trim($_POST['email']);
    }
    if(empty($cContent)) {
        $q = "SELECT user_id FROM users WHERE email='$e' AND user_id!=$id";
        $ps = $pdo->prepare($q);
	$params = array('e' => $e, 'id'=>$id);
	$ps->execute($params);
	if($ps->rowCount() == 0){
            $q = "UPDATE users SET first_name=:fn, last_name=:ln, email=:e WHERE user_id=:id LIMIT 1";
            $ps = $pdo->prepare($q);
            $params = array('fn' => $fn, 'ln' => $ln, 'e' => $e, 'id' => $id);
            $ps->execute($params);
            if( $ps->rowCount() == 1) {
                $cContent[]= '<p>The user has been edited.</p>';
            } else {
                $cContent[]= '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>';
            }
        } else {
            $cContent[]= '<p class="error">Email is already registered!</p>';
	}
    }
}

$q = "SELECT first_name, last_name, email FROM users WHERE user_id=:id";
$ps = $pdo->prepare($q);
$params = array('id'=>$id);
$ps->execute($params);
if( $ps->rowCount() == 1) {
	$row = $ps->fetch(PDO::FETCH_NUM);
	$cContent[] = '<form action="index.php?page=edituser" method="post">
<p>First Name: <input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>Last Name: <input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>
<p>Email Address: <input type="text" name="email" size="20" maxlength="40" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { 
    $cContent[] = '<p class="error">This page has been accessed in error.</p>';
}
