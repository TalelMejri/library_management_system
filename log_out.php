<?php
 if(empty($_SESSION['name'])){
    header("location:login.php");
    exit;
  }
    session_start();
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['user_name']);
    header ('location:login.php');
?>