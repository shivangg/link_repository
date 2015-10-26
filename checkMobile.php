 <?php
// Array with names
$takenMobile=Array();
//$user_ids=Array();
require_once('template/connect.php');
require_once('template/startsession.php');

    $query="SELECT mobile FROM user_table";
    $data=mysqli_query($link,$query);
    
    while($row=mysqli_fetch_array($data))
    {
        $takenMobile[]=$row['mobile'];
    }

sleep(2);
	
	if ($_REQUEST['mobile']=='') {
		echo 'denied';
	}

	else if (!in_array( $_REQUEST['mobile'], $takenMobile )) {
	echo 'okay';
} else {
	echo 'denied';
}
//mysqli_close($link);
?>