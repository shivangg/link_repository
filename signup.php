<?php
  require_once('template/connect.php');
  require_once('template/startsession.php');
  // Insert the page header
  $page_title = 'Sign Up';
  //apply this page's style
  $page_style='<link rel="stylesheet" type="text/css" href="style/register_style.css" />';
  require_once('template/header.php');
  require_once('template/navmenu.php');
  
  
  if (isset($_SESSION['user_id']))      //redirect to dashboard if logged in
    {
      header('location:dashboard.php');
    }



  if (isset($_POST['submit'])) 
  {
    // take profile data from the POST
    $username = mysqli_real_escape_string($link, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($link, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($link, trim($_POST['password2']));
    $email = mysqli_real_escape_string($link, trim($_POST['email']));
    $age = mysqli_real_escape_string($link, trim($_POST['age']));
    $mobile = mysqli_real_escape_string($link, trim($_POST['mobile']));
    $sex = mysqli_real_escape_string($link, trim($_POST['sex']));
    $work = mysqli_real_escape_string($link, trim($_POST['work']));
    $dob = mysqli_real_escape_string($link, trim($_POST['dob']));
    $name=mysqli_real_escape_string($link, trim($_POST['name']));
    $tagline=mysqli_real_escape_string($link, trim($_POST['tagline']));
    $img_type=$_FILES['photo']['type'];
    if($img_type=='image/gif' || $img_type=='image/jpg' || $img_type=='image/png'||$img_type=='image/jpeg')
    {

    }
    else
    {
      header("loction:signup.php");
    }
    /*$picture = mysqli_real_escape_string($link, trim($_FILES['picture']['name']));
    $picture_type = $_FILES['picture']['type'];
    $error=false;

    if (!empty($picture)) {
      if (($picture_type == 'image/gif') || ($picture_type == 'image/jpg') || ($new_picture_type == 'image/png'))
        {
          $target = 'images/' . basename($picture);
          move_uploaded_file($_FILES['picture']['tmp_name'], $target);
        }
       }
    
      */

    // setcookie('name',$name);    
    // setcookie('username',$username);
    // setcookie('email',$email);
    // setcookie('age',$age);
    // setcookie('mobile',$mobile);
    // setcookie('sex',$sex);
    // setcookie('work',$work);
    // setcookie('dob',$dob);
    // setcookie('tagline',$tagline);
   // setcookie('picture',$picture);

    echo $username.$password1.$password2.$email.$age.$mobile.$sex.$work.$dob.$name;     //data correct till here

    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2) && !empty($email) && !empty($age) && !empty($mobile) && !empty($sex) && !empty($dob) && !empty($work) && !empty($name))
     {
      // none with same username
      $query = "SELECT * FROM user_table WHERE username = '$username' or email='$email' or mobile='$mobile'";
      $data = mysqli_query($link, $query);
      if (mysqli_num_rows($data) == 0) 
      {
        // username unique
        $query2 = "INSERT INTO user_table (username, email, mobile, password1, tagline, name, age, sex, dob, work) VALUES ('$username', '$email', $mobile ,SHA('$password1'), '$tagline', '$name', $age ,'$sex', '$dob', '$work') ";
        mysqli_query($link, $query2);
        
        $queryconfirm = "SELECT * FROM user_table WHERE username = '$username'";
        $data = mysqli_query($link, $queryconfirm);

        if (mysqli_num_rows($data)==1) {
        // Confirm success with the user
        $tmp_name=$_FILES['photo']['tmp_name'];
        move_uploaded_file($tmp_name,"users/$username.jpg");        
                //echo '<p>Your new account has been successfully created! You\'re now ready to <a href="index1.php">log in</a> and share your favourite links.</p>';
        
        // delete signup cookies
        // setcookie('name','',time()-100);  
        // setcookie('username','',time()-100);
        // setcookie('email','',time()-100);
        // setcookie('age','',time()-100);
        // setcookie('mobile','',time()-100);
        // setcookie('sex','',time()-100);
        // setcookie('work','',time()-100);
        // setcookie('dob','',time()-100);
        // setcookie('tagline','',time()-100); 
        //setcookie('picture','',time()-100);

        }
        mysqli_close($link);
        //exit();
        //directed to dashboard
        header('location:dashboard.php');
      }
      else 
      {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username/mobile/email address. Please use a different address.</p>';
        $username="";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
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
<script type="text/javascript" src="scripts/utils.js"></script>
<script type="text/javascript" src="scripts/validation.js"></script>

<p>Please enter your information to sign up to Link Repository.</p>
<div id="main">
<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
  
    
    <input type="text" id="name" name="name" value="<?php if(!empty($_COOKIE['name'])) echo $_COOKIE['name'];?>" 
    class=" form-control" placeholder=" What's your Name?" onblur="validateName(this,document.getElementById('name_help'))" />
    <span id="name_help" class="help"></span> <br />
    
    <input type="text" autocomplete="off" id="username" name="username" value="<?php
    if(!empty($_COOKIE['username'])) echo $_COOKIE['username'];?>"  
    class="form-control " placeholder=" Choose a Username" onblur="validateName(this,document.getElementById('username_help'))" />
    <span id="username_help" class="help"></span> <br />
    
    <input type="password" autocomplete="off" id="password1" name="password1" placeholder=" Enter Password" class="form-control " onblur="validatePassword(this,document.getElementById('password_help'))"/>
    <span id="password_help" class="help"></span><br />
    
    <input type="password" autocomplete="off" id="password2" name="password2" placeholder=" Repeat Password" class="form-control " onblur="validateRepeatPassword(this.form,document.getElementById('password2_help'))"/>
    <span id="password2_help" class="help"></span><br />
    
    <input type="text" id="email" autocomplete="off" class="form-control " value="<?php if(!empty($_COOKIE['email'])) 
    echo $_COOKIE['email'];?>"  name="email" placeholder=" Fill your Email address" class="" onblur="validateEmail(this, document.getElementById('email_help'))" />
    <span id="email_help" class="help"></span><br />
    
    <input type="text" id="mobile" autocomplete="off" class="form-control " name="mobile" value="<?php if(!empty($_COOKIE['mobile'])) echo $_COOKIE['mobile'];?>"  placeholder=" What's Mobile number?" onblur="validateMobile(this, document.getElementById('mobile_help'))"/>
    <span id="mobile_help" class="help"></span><br />
    
    <input type="text" id="age" name="age" value="<?php if(!empty($_COOKIE['age'])) 

echo $_COOKIE['age'];?>"  class="form-control" placeholder=" How old are you?" />
    <span id="age_help" class="help"></span><br />
    <label for="sex" id="sex" onblur="validateNonEmpty(this, document.getElementById('sex_help'))" ></label>
       Male<input type="radio" name="sex" value="m" <?php if(isset($_COOKIE['sex'])){ if($_COOKIE['sex']=='m') {
        echo 'checked="check"';          
      } }?> />
      Female<input type="radio" name="sex" value="f" <?php if(isset($_COOKIE['sex'])){ if ($_COOKIE['sex']=='f') {
        echo 'checked="check"';          
      } } ?> />
     <span id="sex_help" class="help"></span><br /> 
   
    <input type="text" id="tagline" name="tagline" value="<?php if(!empty($_COOKIE

['tagline'])) echo $_COOKIE['tagline'];?>"  class="form-control form-control " placeholder="Enter Your Tagline" onblur="validateName(this, document.getElementById('tagline_help'))" />
    <span id="tagline_help" class="help"></span> <br />
   
    <input type="text" id="dob" name="dob" class="form-control " value="<?php if(!empty

($_COOKIE['dob'])) echo $_COOKIE['dob'];?>"  placeholder=" Enter Date of birth (yyyy-mm-mm)" onblur="validateDate(this, document.getElementById('date_help'))" />
    <span id="date_help" class="help"></span> <br />
   
    <input type="text" id="work" name="work" class="form-control " value="<?php if(!empty

($_COOKIE['work'])) echo $_COOKIE['work'];?>" placeholder=" What do you do?" onblur="validateName(this, document.getElementById('work_help'))" />
    <span id="work_help" class="help"></span> <br />

    <input type="file" name="photo" id="photo"  required>

    <!--<input type="file" id="picture" name="picture" class="" value="<?php //if(!empty($_COOKIE['picture'])) echo $_COOKIE['picture'];?>" /> -->
    
    <input type="submit" value="Sign Up" id="submit" class="btn btn-primary" 

name="submit" />
</form>
</div>

<?php
  // Insert the page footer
  require_once('template/footer.php');
?>
</body>