<?php
  session_start();
  if (isset($_SESSION['user_id'])) {
  //delete the session array
    $_SESSION = array();

    //delete cookie having current session id
    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 100);
    }

    // Destroy the session
    session_destroy();
  }

  setcookie('user_id', '', time() - 100);
  setcookie('username', '', time() - 100);

  header('Location: index1.php');
?>
