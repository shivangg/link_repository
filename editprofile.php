<?php
  require_once('template/startsession.php');
  require_once('template/connect.php');

  // Insert the page header
  $page_title = 'Edit profile';
  //apply this page's style
  $page_style='<link rel="stylesheet" type="text/css" href="style/register_style.css" />';
  require_once('template/header.php');
  require_once('template/navmenu.php');
  
  if (!isset($_SESSION['user_id'])) {
    header('location:index1.php');
  }


  $query="SELECT * FROM user_table WHERE user_id='".$_SESSION['user_id']."'";
  $result=mysqli_query($link, $query);
  $data=mysqli_fetch_array($result);
  extract($data);
 
  if (isset($_POST['submit'])) 
  {
    // take profile data from the POST
    $password1 = mysqli_real_escape_string($link, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($link, trim($_POST['password2']));
    $age = mysqli_real_escape_string($link, trim($_POST['age']));
    $sex = mysqli_real_escape_string($link, trim($_POST['sex']));
    $work = mysqli_real_escape_string($link, trim($_POST['work']));
    $dob = mysqli_real_escape_string($link, trim($_POST['dob']));
    $name=mysqli_real_escape_string($link, trim($_POST['name']));
    $tagline=mysqli_real_escape_string($link, trim($_POST['tagline']));
    $img_type=$_FILES['photo']['type'];
    if($img_type=='image/gif' || $img_type=='image/jpg' || $img_type=='image/png' || $img_type=='image/jgeg')
    {

    }
    else
    {
      header("loction:editprofile.php");
    }

    if (!empty($password1) && !empty($password2) && ($password1 == $password2) && !empty($age) && !empty($sex) && !empty($dob) && !empty($work) && !empty($name))
     {
      $pass_hash=sha1($password1);
      $query="UPDATE user_table SET tagline = '".$tagline."', name = '".$name."', age = '".$age."', dob ='".$dob."', work = '".$work."', password1 = '".$pass_hash."' WHERE user_id =".$_SESSION['user_id'];


        mysqli_query($link, $query);
        
        $queryconfirm = "SELECT * FROM user_table WHERE user_id = ".$_SESSION['user_id'];
        $data = mysqli_query($link, $queryconfirm);

        $tmp_name=$_FILES['photo']['tmp_name'];
        move_uploaded_file($tmp_name,"users/$username.jpg");
        if (mysqli_num_rows($data)==1) {
        // Confirm success with the user
        
        echo '<p>Your new account has been successfully updated!</p>';
        
        
        
        
        
        
        
        
        

        }
       // echo $password1.$password2.$age.$sex.$work.$dob.$name;     //data correct till here
        mysqli_close($link);
        
        //directed to dashboard
        header('location:dashboard.php');
      }
    else {
      echo '<p class="error">Leave no field empty.</p>';
    }
  }

  
  mysqli_close($link);
?>
<body> 
<script type="text/javascript" >
  function validateRegEx (regex, input, helpText, helpMessage) 
      {
        if (!regex.test(input))
          {
                    //if (helpText != null)
                  helpText.innerHTML = helpMessage;
                return false;
          }
        else
          {
                //if (helpText != null)
                helpText.innerHTML = "";
              return true;
          }
      }

  function validateLength(minLength, maxLength, inputField, helpText) {
        return validateRegEx(new RegExp("^.{" + minLength + "," + maxLength + "}$"),
        inputField.value, helpText,
          "Please enter a value " + minLength + " to " + maxLength +" characters in length.");//object of reg ex when using eternal variable in it.
       }
  function validateNonEmpty(inputField, helpText)
    {
      return validateRegEx(/.+/,inputField.value, helpText, "Please enter a value.")
    }
  function validateName(inputField,helpText)
       {
         if (!validateNonEmpty(inputField, helpText)) {
           return false;
         }
         return true;
       }
  function validateDate(inputField, helpText) 
    {
      if (!validateNonEmpty(inputField, helpText))
        return false;
      return validateRegEx(/^\d{4}-\d{2}-\d{2}$/,
        inputField.value, helpText,
        "Please enter a date (for example, 1996-12-26).");
      }
  function validateMobile(inputField, helpText)
      {
      if (!validateNonEmpty(inputField, helpText))
      return false;
      return validateRegEx(/^\d{10}$/,
      inputField.value, helpText,
      "Please enter a phone number (for example, 123-456-7890).");
      }
  function validateEmail(inputField, helpText)
    {
      if (!validateNonEmpty(inputField, helpText))
      return false;
      return validateRegEx(/^[\w\.-_\+]+@[\w-]+(\.\w{2,3})+$/,
         inputField.value, helpText,
         "Please enter an email address (for example, example@gmail.com).");
         }
  function validatePassword(inputField, helpText)
    {
      if(!validateNonEmpty(inputField, helpText))
        return false;
      return validateRegEx(/^\w{5,10}$/,inputField.value, helpText,"Please enter a password of 5 to 10 alphanumeric characters.");
    }
  function validateRepeatPassword (form,helpText)
  {
    if (form["password1"].value!=form["password2"].value)
      {
      helpText.innerHTML="Repeated password does not match the original password ";
      
      return false;
      }
    else
      {
      helpText.innerHTML="";
      return true;
      }
  }
</script>


<p>Edit your profile in Link Repository account.</p>
<div id="main">
<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  
    
    <input  type="text" id="name" name="name" value="<?php if(!empty($name)) echo $name;?>" 
    class="field form-control" placeholder=" Wanna change your Name?" onblur="validateName(this, document.getElementById('name_help'))" />
    <span id="name_help" class="help"></span> <br />
    
    <input type="password" id="password1" name="password1"  placeholder=" New Password" class="field form-control" onblur="validatePassword(this, document.getElementById('password_help'))"/>
    <span id="password_help" class="help"></span><br />
    
    <input type="password" id="password2" name="password2"  placeholder=" Repeat New Password" class="field form-control" 
    onblur="validateRepeatPassword(this.form,document.getElementById('password2_help'))"/>
    <span id="password2_help" class="help"></span><br />
    
    <input type="text" id="age" name="age" value="<?php if(!empty($age)) echo $age;?>"  class="field form-control" placeholder=" Wanna change your age?" />
    <span id="age_help" class="help"></span><br />

    <label for="sex" id="sex" onblur="validateNonEmpty(this, document.getElementById('sex_help'))" ></label>
      <div  class="field form-control"> Male<input type="radio" name="sex" value="m" <?php if(isset($sex)){ if ($sex=='m') {
        echo 'checked="check"';          
      } }?> />
      Female<input type="radio" name="sex" value="f" <?php if(isset($sex)){ if ($sex=='f') {
        echo 'checked="check"';          
      } } ?> />
     <span id="sex_help" class="help"></span></div><br /> 
   
    <input type="text" id="tagline" name="tagline" value="<?php if(!empty($tagline)) echo $tagline;?>"  class="field form-control" placeholder=" Enter Your Tagline" onblur="validateName(this, document.getElementById('tagline_help'))" />
    <span id="tagline_help" class="help"></span> <br />
   
    <input type="text" id="dob" name="dob" class="field form-control" value="<?php if(!empty($dob)) echo $dob;?>"  placeholder=" Enter Date of birth (yyyy-mm-mm)" onblur="validateDate(this, document.getElementById('date_help'))" />
    <span id="date_help" class="help"></span> <br />
   
    <input type="text" id="work" name="work" class="field form-control" value="<?php if(!empty($work)) echo $work;?>" placeholder=" What do you do?" onblur="validateName(this, document.getElementById('work_help'))" />
    <span id="work_help" class="help"></span> <br />

    <input type="file" id="photo" name="photo" class="field form-control"> 

    <!--<input type="file" id="picture" name="picture" class="field form-control" value="<?php //if(!empty($picture)) echo $picture;?>" /> -->
    
    <input type="submit" class="btn btn-primary" value="Edit" id="submit" name="submit" />
</form>
</div>

<?php
  // Insert the page footer
  require_once('template/footer.php');
?>
</body>