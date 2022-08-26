<?php
  
    session_start();
    if(!isset($_SESSION['name'])){
        header('location:./login');
        exit;
    }
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['user_name']);
    header ('location:./login');
?>