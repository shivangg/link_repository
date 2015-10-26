<form method="POST" >
    <label>Enter Name of the site whose Div you want to view:</label>
  <input type="text" name="url" id="url"></input></br>
  <input type="submit" name="submit" id="submit" value="Submit"></input>
</form>

<?php
error_reporting(E_ALL & ~E_WARNING);//To remove warning that are pre-existing in a site  
extract($_POST);
set_time_limit(150);
$title="";//title of the page 
$image_src="";//Src of a page
$desc="";//decription of a page in text
$dom=new DOMdocument();
$dom->loadHTMLFile($url);
if (strpos($url,'www.youtube.com/watch?v') !== false)// Added Functionality for youtube video instead of img_src embeded url is saved 
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
      $image_src_temp=$url.'/'.$src_img;
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
?>
<div>
<h1><?php echo $title;?></h1></br>
<?php if (strpos($url,'www.youtube.com/watch?v') !== false)
{ 
  ?>
  <iframe width="450" height="250"
src="<?php echo $image_src.'?autoplay=0';?>">
<?php
echo "</iframe>";
}
else
{
  ?>
<div><img src="<?php echo $image_src; ?>" height="100" width="100"/></div>
<?php
}
?>
<div><?php echo $desc; ?></div>
</div>