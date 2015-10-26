<?php
  // Generate the navigation menu
  if (isset($_SESSION['user_id']))
    {
      echo '<a class="btn btn-info" href="dashboard.php">Home</a>  ';
      echo '<a class="btn btn-info" href="viewprofile.php?q='.$_SESSION['user_id'].'"">View your Profile</a>  ';
      echo '<a class="btn btn-info" href="editprofile.php">Edit your Profile</a>  ';
      echo '<a class="btn btn-info" href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
    }
  else
    {
      echo '<li><a class="btn btn-info" href="index1.php">Log In</a> </li> ';
      echo '<li><a class="btn btn-info" href="signup.php">Sign Up</a></li>';
    }
 
?>
