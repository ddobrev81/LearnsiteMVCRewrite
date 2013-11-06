<?php #login.php

if( isset($_POST['submitted'])) {
    require_once('includes/dbc.php');
    list($check, $data) = check_login($pdo, $_POST['email'], $_POST['pass']);
    if($check) {
        setcookie('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
	session_start();
	$_SESSION['user_id']= $data['user_id'];
	$_SESSION['first_name'] = $data['first_name'];
	$_SESSION['email']= $data['email'];
	$url = absolute_url('index.php?page=loggedin');
	header("Location: $url");
	exit();
    } else {
	$errors=$data;
    }
}
if(!empty($errors)) {
    $cContent[] = '<h1> Error!</h1>
    <p class="error"> The following error(s) occurred:<br />
    ';
    foreach($errors as $msg) {
	$cContent[]= "- $msg<br />\n";
    }
    $cContent[]= '</p><p>Please try again!</p>';
}
$cContent[] ='
<form action="index.php?page=login" method="post">
	<p><input type="text" name="email" placeholder="Email Address"size=20 maxlength=20 /></p>
	<p><input type="password" name="pass" placeholder="Password" size=20 maxlength=20 /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
	<input type="hidden" name="submitted" value="TRUE"/>
</form>
<br>
<p>If you dont have an account, register <a href="index.php?page=register">here.</a></p>
<p>You can view/edit/delete users <a href="index.php?page=viewusers">here.</a></p>
<p>Change your password - <a href="index.php?page=password">here.</a></p>
';
