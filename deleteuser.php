<?php 
     session_start();
     include "./classes/admin_user.php";
     $user=new user();
     $user->deleteuser($_GET['id']);
     header("location:./alluser?msg=delete done&type=success");
     exit;
?>