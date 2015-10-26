 <?php
// Array with names
$takenEmail=Array();
//$user_ids=Array();
require_once('template/connect.php');
require_once('template/startsession.php');

    $query="SELECT email FROM user_table";
    $data=mysqli_query($link,$query);
    
    while($row=mysqli_fetch_array($data))
    {
        $takenEmail[]=$row['email'];
    }

sleep(2);
	
	if ($_REQUEST['email']=='') {
		echo 'denied';
	}

	else if (!in_array( $_REQUEST['email'], $takenEmail )) {
	echo 'okay';
} else {
	echo 'denied';
}
//mysqli_close($link);
?>