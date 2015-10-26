<?php
include("template/connect.php");
if(!isset($_SESSION['user_id']))
	session_start();
$id=$_SESSION['user_id'];
//$id=1;// FOR TESTING ___
$followed_array= array();
$i=0;
$check_follow="select followed_id from follow_table where follower_id='$id'";
$query_follow=mysqli_query($link,$check_follow);
$query_retreive_dom="select * from links_table where ";
while ( $follow_array=mysqli_fetch_array($query_follow)) 
	{
      $query_retreive_dom=$query_retreive_dom.'user_id= '.$follow_array['followed_id'].' or ';
    }
$final_query_dom=$query_retreive_dom."user_id= '$id' ORDER BY time_added DESC";
$query_final=mysqli_query($link,$final_query_dom);
while($saved_dom=mysqli_fetch_array($query_final))
{ extract($saved_dom);
	$fetch_name="select name from user_table where user_id='$user_id'";
	$query_fetch_name=mysqli_query($link,$fetch_name);
	$arr=mysqli_fetch_array($query_fetch_name);

if(	$user_id==$_SESSION['user_id'] || $mode==1)
      {
		$name=$arr['name'];
	    if($photo_location!="")   
	               {	
			?>
		<div class="layout1" >
		        <!-- <div class="fav_icon"><a href="<?php// echo $theUrl;  ?>" target="_blank"><img src="<?php //echo $fav_icon; ?>" class="image_added"></a></div>-->
		       <div class="title"><a href="<?php echo $url; ?>" target="_blank"><h2><?php echo $title; ?></h2></a> <hr /><p class="added_text">added by <b><a class="btn btn-xs btn-default" href="viewprofile.php?q=<?php echo $user_id; ?>"><?php echo $name;?></a></b></p></div>
		          <div class="row">
		              <div class="left_dom col-sm-6">
			          <div class="image_added col-sm-12">
				          <?php 	if (strpos($url,'www.youtube.com/watch?v') !== false)
											{ 
							?>
												<iframe  src="<?php echo $photo_location.'?autoplay=0';?>" width="100%" height="100%">
							<?php
												echo "</iframe>";
										     }
					                else
						                     {
					  	?>
					  	                           <img src="<?php echo $photo_location; ?>" width="100%" height="100%"/>
					  	     <?php
		              	         				 }
							?>
					  </div>
		           </div>
		          <div class="right_dom col-sm-6">
		          <?php if($user_desc!="")
		          	{
			          echo '<div class="user_desc_url">'.$user_desc.'</div></br>';
			        }?>
			        
			          <div class="crawl_desc_url"><?php echo $crawl_desc; ?></div>
		          </div>
		          </div>
		</div></br>
		 <?php
		 				}
		else 
				{
			?>
		<div class="layout2" >
		     <!--   <div id="icon" class="fav_icon"><a href="<?php echo $theUrl;  ?>" target="_blank"><img src="<?php echo $fav_icon; ?>" class="image_added"></a></div>-->
		          <div class="title"><a href="<?php echo $url; ?>" target="_blank"><h2><?php echo $title; ?></h2></a><p class="added_text"> added by <b><a href="viewprofile.php?q=<?php echo $user_id; ?>"><?php echo $name;?></a></b></p></div>
		          <div class="user_desc_url"><?php if($user_desc!="") echo $user_desc; ?></div>
		          <div class="crawl_desc_url"><?php echo $crawl_desc; ?></div>
		</div></br>
		<?php
			}	
	    }
	}
?>