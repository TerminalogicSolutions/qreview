<?php
  session_start();
  if (!isset($_SESSION['loggedin'])) {
      header("Location: login.php");
      exit;
  } else {

//
  $attempts = ("attempts.txt");
  if (file_exists($attempts)) {
      //  If attempts.txt exists delete it
     unlink($attempts);
  } 
//
      unset($_SESSION['loggedin']);
      header("Location: login.php");
      exit;
      // the session variable exists
  }
?>


