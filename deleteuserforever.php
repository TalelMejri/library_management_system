<?php 
 
   session_start();
   if(!isset($_SESSION['name'])){
      header("location:../login");
      exit;
  }
  if(!array_key_exists('id',$_GET)){
   header("location:../login");
   exit;
  }
   require_once("./classes/classes.php");
   $user=new user();
   $user->deleteuserforever($_GET['id']);

   header("location:./listuserdeleted?msg=delete for ever&type=danger");
   exit;
?>