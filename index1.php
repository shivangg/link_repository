<div style='position:absolute;z-index:-199;left:0;top:0;width:100%;height:100%'>
  <img src='images/background.png' style='width:100%;height:100%' alt='background' />
</div>
<script type="text/javascript" src="scripts/utils.js"></script>
<script type="text/javascript" src="scripts/validlogin.js"></script>
<?php

  require_once('template/connect.php');
  require_once('template/startsession.php');
  // Insert the page header
  $page_title = 'Login';
  //apply this page's style
  $page_style='<link rel="stylesheet" type="text/css" href="style/login_style.css" />';
  require_once('template/header.php');
  require_once('template/navmenu.php');
  

  //error_reporting(E_ALL & ~E_WARNING);
  extract($_POST);
  $msg="";

  if (isset($_SESSION['user_id']))      //redirect to dashboard if logged in
    {
      header('location:dashboard.php');
    }


  if(isset($submit))
   {
      if(!empty($user_login_entry) && !(empty($password1)))
        {  
               $user_login_entry=mysqli_real_escape_string($link,htmlentities(trim($user_login_entry))); //sql injections
               $password1=mysqli_real_escape_string($link,htmlentities(trim($password1))); //sql injections
               $pass_hash=sha1($password1);
               $select_query="select user_id,password1,username from user_table where username='$user_login_entry' or email='$user_login_entry' or mobile='$user_login_entry'";
               $query_check_user=mysqli_query($link, $select_query);
               if(mysqli_num_rows($query_check_user)==1)
                 {
                 	     $array_user_login=mysqli_fetch_array($query_check_user);
                       extract($array_user_login);
                 	  if($pass_hash==$password1)
                    	{   
                           //session_start();
                           
                           $_SESSION['user_id']=$user_id;
                           setcookie('user_id',$user_id,time()+(24*60*60)); //expire after a day
                           $_SESSION['username']=$username;
                           setcookie('username',$username,time()+(24*60*60)); //expire after a day
                           //$msg=$_SESSION['user_id'];
                           header("location:dashboard.php");
                 	    }
                 	  else
                 	    {
                 	  	     $msg="Password did not match!!";
                 	    }
                 }
                 else
                 {
                 	$msg="User Data not Found";
                 }
         }
   else
   {
   	$msg="Fields should not be empty !";
   }
 }
if(isset($signup))
{
  header("location:signup.php");
} 
?>

<div id="main_index" class="main_index">
		
   <div id ="login_form" class="row">
   <div class="col-sm-6"><img style="border:1px solid #78CEDD;" id="loginPicture" alt="loginPicture" width="100%" src=""></div>
	<form class="col-sm-6" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	<span style="color:red;"><?php echo $msg;?></span><br />
       Email/Mobile/Username<input type="text" class="form-control" name="user_login_entry" id="user_login_entry" value="<?php if(isset($user_login_entry)) echo $user_login_entry;?>" ></td>
  Password:
   	<input type="password" class="form-control" id="password1" name="password1" autocomplete="off"></td>
    <input type="submit" class="btn btn-default" value="Log In" id="submit" name="submit">
		<input type="submit" class="btn btn-default" value="Sign Up" id="signup" name="signup">

    
</form>
	</div>
</div>	
</body>
</html>