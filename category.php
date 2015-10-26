<?php
$query_category=mysqli_query($link,"select * from category_table");
while($array_category=mysqli_fetch_array($query_category))
	  {extract($array_category);
  ?>
<div class="category_list"><a href="dashboard.php?page=category&&category=<?php echo $category_id; ?>"><?php echo $category_name; ?> </a></div>
  <?php
	  }
  if($category=$_REQUEST['category'])
{
  $query_category_display=mysqli_query($link,"select * from links_table where category_id='$category' ORDER BY time_added DESC");
  while($saved_dom=mysqli_fetch_array($query_category_display))
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
			        <!-- <div class="fav_icon"><a href="<?php echo $theUrl;  ?>" target="_blank"><img src="<?php echo $fav_icon; ?>" class="image_added"></a></div>-->
			       <div class="title"><a href="<?php echo $url; ?>" target="_blank"><h2><?php echo $title; ?></h2></a> <p class="added_text">added by <b><a href="viewprofile.php?q=<?php echo $user_id; ?>"><?php echo $name;?></a></b></p></div>
			          <div class="left_dom">
				          <div class="image_added">
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
			          <div class="right_dom">
				          <div class="user_desc_url"><?php if($user_desc!="") echo $user_desc; ?></div></br></br>
				          <div class="crawl_desc_url"><?php echo $crawl_desc; ?></div>
			          </div>
			</div></br>
			 <?php
			 				}
			else 
					{
				?>
			<div class="layout2" >
			     <!--   <div id="icon" class="fav_icon"><a href="<?php echo $theUrl;  ?>" target="_blank"><img src="<?php echo $fav_icon; ?>" class="image_added"></a></div>-->
			          <div class="title"><a href="<?php echo $url; ?>" target="_blank"><h2><?php echo $title; ?></h2></a> added by <a href="viewprofile.php?q=<?php echo $user_id; ?>"><?php echo $name;?></a></div>
			          <div class="user_desc_url"><?php if($user_desc!="") echo $user_desc; ?></div>
			          <div class="crawl_desc_url"><?php echo $crawl_desc; ?></div>
			</div></br>
			<?php
				}	
		    }
		}
}
	?>