<?php 
     session_start();
     require_once("./classes/classes.php");
     $user=new user();
     $user->backuser($_GET['id']);
     header("location:./listuserdeleted?msg=user back&type=success");
     exit;
?>