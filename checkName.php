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

sleep(2);
	if ($_REQUEST['username']=='') {
		echo 'denied';
	}

	else if (!in_array( $_REQUEST['username'], $takenUsernames )) {
	echo 'okay';
} else {
	echo 'denied';
}
//mysqli_close($link);
?>