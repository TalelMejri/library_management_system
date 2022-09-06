<?php 
 
   session_start();
   require_once("./classes/classes.php");
   $user=new user();
   $user->deleteuserforever($_GET['id']);

   header("location:./listuserdeleted?msg=delete for ever&type=danger");
   exit;
?>