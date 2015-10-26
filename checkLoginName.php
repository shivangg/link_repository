 <?php
// Array with names
$takenUsernames=Array();
//$user_ids=Array();
require_once('template/connect.php');
require_once('template/startsession.php');

    $query="SELECT username FROM user_table";
    $data=mysqli_query($link,$query);
    
    while($row=mysqli_fetch_array($data))
    {
        $takenUsernames[]=$row['username'];
    }

sleep(1);
	if ($_REQUEST['user_login_entry']=='') {
		echo 'denied';
	}

	else if (!in_array( $_REQUEST['user_login_entry'], $takenUsernames )) {
	echo 'denied';
} else {
	echo $_REQUEST['user_login_entry'];
}

?>