<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>DDobrev's site</title>	
	<link rel="stylesheet" href="includes/style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<div class="wrapper">
	<div id="user" >
        <p> 
        	<?php
        	if((isset($_SESSION['user_id'])) && (!strpos($_SERVER['PHP_SELF'],'logout.php')) ) {
        		$user_fn = (string)$_SESSION['first_name'];
        		echo "Welcome, <b>$user_fn</b>"; 
        		echo '<a href="index.php?page=logout"> Logout?</a>';
        	} else {
        		echo 'You are not logged in!';
        		echo '<a href="index.php?page=login"> Login?</a>';
        	}
        	?>
        </p>
    </div>
	<div id="header">
		<h1>DDOBREV</h1>
		<h2>The first steps...</h2>
	</div>
	<div id="navigation">
		<ul>
<li><a href="index.php?page=main">Home
 Page</a></li>
<li><a
 href="index.php?page=showquotes">Quote-o-matic</a></li>
<li><a href="index.php?page=underconstruction">Blog</a></li>
<li><a href="index.php?page=shoutbox">Shoutbox</a></li>
<li>
<?php
if((isset($_SESSION['user_id'])) && (!strpos($_SERVER['PHP_SELF'],'logout')) ) {
    echo '<a href="index.php?page=logout">Logout</a>';
} else {
    echo '<a href="index.php?page=login">Login</a>';
}
?>
</li>
			
		</ul>
	</div>
	<div id="content">
		
