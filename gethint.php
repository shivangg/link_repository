<?php
// Array with names
$usernames=Array();
//$user_ids=Array();
require_once('template/connect.php');
require_once('template/startsession.php');

    $query="SELECT username FROM user_table";
    $data=mysqli_query($link,$query);
    
    while($row=mysqli_fetch_array($data))
    {
        $usernames[]=$row['username'];
       //$user_ids[]=$row['user_id'];
    }

    


// get s parameter thru GET request
$s = $_REQUEST["s"];

$hint= Array();
$user_ids=Array();

// lookup all hints from array if $s is different from "" 
if ($s !== "") {
    $s = strtolower($s);
    $len=strlen($s);
    foreach($usernames as $name) {
        if (stristr($s, substr($name, 0, $len))) {
               $hint[]= $name;
            }
        }
    }




// Output "no suggestion" if no hint was found or output correct values 

if ($hint===array())
    {
        echo "<li>no suggestion</li>";
    }
else
{
    foreach ($hint as $name) {
        $query2="SELECT user_id FROM user_table WHERE username='".$name."'";
        $data2=mysqli_query($link,$query2);
        $row2=mysqli_fetch_array($data2);
        $user_id=$row2['user_id'];
    
    echo '<li><a href="viewprofile.php?q='.$user_id.'"">'.$name.' </a></li>';
}
}
mysqli_close($link);
?>
