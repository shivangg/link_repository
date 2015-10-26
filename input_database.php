<?php
require_once('template/connect.php');
require_once('template/startsession.php');
extract($_POST);
if(isset($submit))
   { 
   	 include('template/connect.php');
		  $user_id=$_SESSION['user_id'];
			//$user_id=1; //To  test the code .....
				$check_query="select * from links_table where url ='$theUrl' and user_desc='$user_desc' and category_id='$category' ";
				$query_check_url=mysqli_query($link,$check_query);
				if(mysqli_num_rows($query_check_url)==0) // first check if any user prior to him has once saved that link
							{  
								$select_query="INSERT INTO links_table (link_id ,user_id , category_id, title ,user_desc, crawl_desc, url, photo_location, mode ,time_added) VALUES (NULL,'$user_id', '$category','$title' ,'$user_desc', '$desc', '$theUrl', '$image_src','$mode',CURRENT_TIMESTAMP)";
								$query_add_dom=mysqli_query($link,$select_query);
			                    header("location:dashboard.php");			        			
							}
			         
   }
   ?>