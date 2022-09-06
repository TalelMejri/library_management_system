<?php 
     session_start();
     require_once("./classes/classes.php");
     $user=new user();
     $user->deleteuser($_GET['id']);
     header("location:./alluser?msg=delete done&type=success");
     exit;
?>