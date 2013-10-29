<?php #view_users_new.php

require_once('./includes/dbc.php');
$display = 5;
if (isset($_GET['p']) && is_numeric($_GET['p'])) {
    $pages = $_GET['p'];
} else {
    $q = "SELECT COUNT(user_id) FROM users";
    $ps = $pdo->prepare($q);
    $ps->execute();
    $result = $ps->fetch();
    $records = $result[0];
    if($records > $display) {
        $pages = ceil($records/$display);
    } else {
        $pages = 1;
    }
}
if(isset($_GET['s']) && is_numeric($_GET['s']))	{
    $start = $_GET['s'];
} else {
    $start =0;
}
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';
switch($sort) {
    case 'ln':
	$order_by = 'last_name ASC';
	break;
    case 'fn':
	$order_by = 'first_name ASC';
	break;
    case 'rd':
	$order_by = 'registration_date ASC';
	break;
    default:
	$order_by = 'registration_date ASC';
	$sort = 'rd';
	break;
}
     
$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id FROM users  ORDER BY $order_by LIMIT $start, $display";
$ps = $pdo->prepare($q);
$ps->execute();

$content[] = '<table align="center" cellspacing="0" cellpadding="5" width="75%">
		<tr>
		<td align="left"><b>Edit</b></td>
		<td align="left"><b>Delete</b></td>
		<td align="left"><b><a href="index.php?page=viewusers&sort=ln">Last Name</a></b></td>
		<td align="left"><b><a href="index.php?page=viewusers&sort=fn">First Name</a></b></td>
		<td align="left"><b><a href="index.php?page=viewusers&sort=rd">Date Registered</a></b></td>
		</tr>';	
$bg = '#eeeeee';
while ($row = $ps->fetch(PDO::FETCH_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		
		$content[] = '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="index.php?page=edituser&id='.$row['user_id'].'">Edit</a></td>
		<td align="left"><a href="index.php?page=deleteuser&id='.$row['user_id'].'">Delete</a></td>
		<td align="left">' . $row['last_name'] .'</td>
		<td align="left">' . $row['first_name']. '</td>
		<td align="left">' . $row['dr'] . '</td></tr>
		';
}
$content[] = '</table>';
if($pages>1) {
		$content[] = '<br /><p>';
		$current_page = ($start/$display)+1;
		if($current_page != 1){
				$content[] = '<a href="index.php?page=viewusers&s=' .($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
		}
		for($i=1; $i<=$pages; $i++) {
                    if($i != $current_page) {
			$content[] = '<a href="index.php?page=viewusers&s=' .(($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';					
                    } else {
                        $content[] = $i.' ';
                    }
		}
		if($current_page != $pages) {
                    $content[] = '<a href="index.php?page=viewusers&s=' .($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
		}
		$content[] = '</p>';
}
