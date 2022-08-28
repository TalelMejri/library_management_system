<?php 
 
   session_start();
   include "./classes/admin_user.php";
   $user=new user();
   $user->deleteuserforever($_GET['id']);

   header("location:./listuserdeleted?msg=delete for ever&type=danger");
   exit;
?>