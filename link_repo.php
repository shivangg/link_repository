<?php
error_reporting(E_ALL & ~E_WARNING);//To remove warning that are pre-existing in a site  
extract($_POST);
set_time_limit(150);
session_start();
if(isset($submit))
{	
$title="";//title of the page 
$image_src="";//Src of a page
$desc="";//decription of a page in text
$dom=new DOMdocument();
$dom->loadHTMLFile($theUrl);
if (strpos($theUrl,'www.youtube.com/watch?v') !== false)// Added Functionality for youtube video instead of img_src embeded url is saved 
{  //echo "hi";
  foreach($dom->getElementsByTagName("link") as $link_tag)
  { 
    if($link_tag->getAttribute('itemprop')=='embedURL')
      {$image_src=$link_tag->getAttribute('href');
               break;
           }
  }
}
/** Image Array  **/
$image_src_attr= array('link' => '1','aspect-ratio' =>10000);
//Title of a page 
foreach($dom->getElementsByTagName("meta") as $meta_ob)
{  //  echo"</br>"; for testing this code
  $meta_content=$meta_ob->getAttribute("content");
  $meta_name=$meta_ob->getAttribute("name");
  // echo $meta_name.$meta_content;//for testing this code
  if(strcasecmp($meta_name, 'og_title')==0)
      $title=$meta_content;
  if($image_src=="")
    if(strcasecmp($meta_name, 'og_image')==0)
     {  if (strpos($meta_content,'load') !== false) {
    continue;
}
      $image_src=$meta_content;
    }   
    if(strcasecmp($meta_name,'description')==0)
      $desc=$meta_content;
  if($title=="")
  {
    if(strcasecmp($meta_name, 'title')==0)
      $title=$meta_content;
  }
}

if($title=="")
{$found=0;
foreach($dom->getElementsByTagName("title") as $url_title)
   {
    if($found!=0)
      break;
    if(!strcasecmp($url_title->nodeValue, '')==0)
    {
      $title=$url_title->nodeValue;
        $found=1; 
        break;
    }
   }
     $array_head_tags= array('h1','h2');
      foreach($array_head_tags as $head)
      {
               if($found!=0)
                break;
          foreach($dom->getElementsByTagName($head) as $head_data)
            {
              $title=$head_data->nodeValue;
              $found=1;
              break;

          } 
      } 
   
}
if($desc=="")
{
//echo "&nbsp;hi"."description";------ testing 
  $found=0;
  $array_desc_tags= array('p','div','h3','h4','h5');
  foreach($array_desc_tags as $desc_tags)
  {   if ($found!=0)
    break;
    foreach($dom->getElementsByTagName($desc_tags) as $tag_data)
    {if(!strcasecmp($tag_data->nodeValue,'')==0)
          {
            $desc=$tag_data->nodeValue;
             $found=1;
                break;
          }
      }
  }
}
if($image_src=="")
{
  $image_src_temp="";
foreach($dom->getElementsByTagName("img") as $img_tag)
      {
         $src_img=$img_tag->getAttribute('src');
 if (strpos($src_img,'load') !== false) {
    continue;
}
 $src_data_url=$img_tag->getAttribute("data-url");
 $src_alias=$src_img;
 $src_alias=filter_var($src_alias,FILTER_SANITIZE_URL);
     if(!filter_var($src_alias,FILTER_VALIDATE_URL)===false && $src_data_url=="")
     {
      $image_src_temp=$src_alias;
     }
     else
     {
      if($src_data_url=="")
      $image_src_temp=$theUrl.'/'.$src_img;
     }
    $image_size_array=getimagesize($image_src_temp);
    if($image_size_array[0]!=0 && $image_size_array[1]!=0)//to prevent Division By zero
    $aspect_ratio=$image_size_array[0]/$image_size_array[1];
        else
        $aspect_ratio=1001;
       if((abs($image_src_attr['aspect-ratio']-1)>abs($aspect_ratio-1))&&($image_size_array[1]*$image_size_array[0])>400)
       {
        $image_src_attr['link']=$image_src_temp;
        $image_src_attr['aspect-ratio']=$aspect_ratio;
        if($aspect_ratio==1)
          break;
       }
     }  
  $image_src=$image_src_attr['link'];    
}
$user_id=$_SESSION['id'];
$user_id=1; //To  test the code .....
$check_query="select * from links_table where url ='$theUrl' and user_desc='$user_desc' and category_id='$category' ";
$query_check_url=mysqli_query($link,$check_query);
if(mysqli_num_rows($query_check_url)==0) // first check if any user prior to him has once saved that link
	{
	$select_query="INSERT INTO links_table (link_id, category_id, user_desc, crawl_desc, url, photo_location, approved) VALUES (NULL, '$category', '$user_desc', '$desc', '$theUrl', '$image_src', '1')";
	$query_add_dom=mysqli_query($link,$select_query);
	}
$check_link_id="select link_id from links_table where url ='$theUrl'";
$query_check_link_id=mysqli_query($link,$check_link_id);
$array_link_id=mysqli_fetch_array($query_check_link_id);
$link_id_URL=$array_link_id['link_id'];
$insert_query_link="INSERT INTO repo_table (user_id,link_repo) VALUES ('$user_id','$link_id_URL')";
mysqli_query($link,$insert_query_link);
}
?>
	<h2>View, share, Explore</h2>
	<p>Paste your favourite links here to make your customised collection of links. Share your favourite links and explore what your friends shared!</p>
	<div id="pasteUrl" >
		<form method="post">
			<input id="theUrl" type="text" placeholder="Paste link here..."  name="theUrl" /></br></br>
			<select id= "mode" name="mode" >
			    <option value="1">Please select a option: </option>
				<option value="public">Public</option>
				<option value="private">Private</option>
			</select>

			<select id= "category" name="category" onchange="category_check()">
			    <option value="0">Please select a category: </option>
				<option value="1">Entertainment</option>
				<option value="2">Knowledge</option>
				<option value="3" >Fun</option>
				<option value="4" >Extras</option>
			</select>
			<input type="text" value"Description" id="user_desc" name="user_desc">
			<input type="submit" value="Post Link" name="submit" />			
		</form>
	</div>
	<h2>Links Feed</h2>
	<!--5 to 6 linkFeed divs follow -->
	<div class="urlFeeds">
		<p>Php generated divs of crawled links will populate this space.</p>
	</div>