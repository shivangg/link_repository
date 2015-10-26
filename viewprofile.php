<?php
require_once('template/connect.php');
require_once('template/startsession.php');
$page_title="View profile";
$page_style='<link rel="stylesheet" type="text/css" href="style/viewprofile_style.css" />';
require_once('template/header.php');
require_once('template/navmenu.php');

$q=$_REQUEST['q'];

$query="SELECT * FROM user_table WHERE user_id=".$q;
$result=mysqli_query($link,$query);
$data=mysqli_fetch_array($result);
extract($data);
extract($_POST);
if(isset($follow))
{
	$query_follow="INSERT INTO links.follow_table (follower_id, followed_id) VALUES ('$_SESSION[user_id]', '$q')";
	if(mysqli_query($link,$query_follow))
	{
		$redirect_url='location:viewprofile.php?q='.$q;
		header($redirect_url);
	}
}
if(isset($unfollow))
{
	$query_unfollow="DELETE from follow_table where follower_id='$_SESSION[user_id]' AND followed_id='$q'";
	if(mysqli_query($link,$query_unfollow))
	{
		$redirect_url='location:viewprofile.php?q='.$q;
		header($redirect_url);
	}
}

?>
<div id="main">

  <img src="Users/<?php echo $username.'.jpg' ?>" style='width:100%;height:100%' alt='profile picture' />
<p class="param">Name: <?php echo "$name"?></p>
<p class="param">Email:<?php echo "$email"?></p>
<p class="param">Mobile:<?php echo "$mobile"?></p>
<p class="param">Your Tagline:<?php echo "$tagline"?></p>
<p class="param">Age:<?php echo "$age"?></p>
<p class="param">Sex:<?php echo "$sex"?></p>
<p class="param">Work:<?php echo "$work"?></p>
	<form method="post" >
		<?php if($_SESSION['user_id']!=$q)
			    {    
			         $follow_unfollow="SELECT * from follow_table where follower_id='$_SESSION[user_id]' AND followed_id='$q'";
			         $num_rows=mysqli_num_rows(mysqli_query($link,$follow_unfollow));
			         if($num_rows==0)
			         { 

		?>
						<input type="submit" value="Follow" name="follow" id="follow" class="follow">
		<?php	
				     }
				     else
				     {
		?>
                      <input type="submit" value="Unfollow" name="unfollow" id="unfollow" class="unfollow">
		<?php
		              }
		        }
		?>
	</form>

</div>
	<?php require_once('template/footer.php'); ?>					
</body>
</html>

