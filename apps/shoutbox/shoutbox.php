<?php #shoutbox.php

session_start();

if(isset($_SESSION['user_id'])) { //check login
    if(isset($_POST['submitted'])) { //check for POST
        //check user input
        if(empty($_POST['subject']) or (mb_strlen($_POST['subject'])>100)) {
            $this->cContent[]='Enter a message subject; maximum of 100 characters.';
        } else {
            $messageSubject = trim($_POST['subject']);
        }
        if(empty($_POST['body']) or (mb_strlen($_POST['body'])>500)) {
            $this->cContent[]='Enter a message body; maximum of 500 characters.';
        } else {
            $messageBody = trim($_POST['body']);
        }
        // user input is ok-ish > add message
        if(empty($this->cContent)) {
            require_once './includes/dbc.php';
            $q = "INSERT INTO shoutbox (user_id, timestamp, subject, body) VALUES (:uid, NOW(), :sbj, :bdy)";
            $ps = $pdo->prepare($q);
            $params = array(
				'uid' => $_SESSION['user_id'],
				'sbj' => $messageSubject,
				'bdy' => $messageBody				
				);
            $ps->execute($params);
        }
    }
            //display messages
            require_once './includes/dbc.php';
            $q = "SELECT * FROM shoutbox ORDER BY timestamp DESC";
            $ps = $pdo->prepare($q);
            $ps->execute();
            // generate html table for each message
            $this->cContent[]='<div style="float:left; width:50%"><br><br>';
            while ($shout = $ps->fetch(PDO::FETCH_ASSOC)) {
                  $this->cContent[]='
                    <table cellspacing="0" style="border:1px solid indigo;width: 95%; word-wrap:break-word; table-layout: fixed;">
                    <tr bgcolor="#C9C9C9"><td><b>'.$shout['message_id'].'.  '.$shout['subject'].'</b></td></tr>
                    <tr bgcolor="#E9E9E9"><td> '.$shout['body'].'</td></tr>
                     <tr></tr>
                    <tr><td style="font-size:75%;">Posted by: '.$_SESSION['email'].'  |  Posted on: '.$shout['timestamp'].'</td></tr>
                    </table>
                    <br>
                    ';
            }
            //the rest of the html 
            $this->cContent[]='
            </div>
            <div style="float:right; width:50%">
            <br>
            <form action="index.php?page=shoutbox" method="post">
            <p><textarea name="subject" placeholder="Message Subject" style="width:330px; height:60px;"></textarea></p>
            <p><textarea name="body" placeholder="Message Body" style="width:330px; height:200px;"></textarea></p>
            <p><input type="submit" name="submit" value="Submit"/></p>
            <input type="hidden" name="submitted" value="TRUE" />
            </form>
            </div>
            ';
} else { // login reminder
	$this->cContent[]='<p>You have to be logged in to view/post!</p>';
}

