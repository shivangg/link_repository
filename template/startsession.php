<?php
if(!isset($_SESSION['user_id']))
  session_start();

  //set session with cookie, if present. Persistent login
  if (!isset($_SESSION['user_id']))
   {
   	if (isset($_COOKIE['user_id']) && isset($_COOKIE['username']))
    	{
      		$_SESSION['user_id'] = $_COOKIE['user_id'];
      		$_SESSION['username']=$cookie['username'];
      	}
      
  }
?>
