<?php
    session_start();
    if(!isset($_SESSION['name']) && !isset($_SESSION['username'])){
        header('location:../login');
        exit;
    }
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['username']);
    header ('location:./login');
?>