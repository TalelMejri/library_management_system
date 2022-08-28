<?php 
     session_start();
     include "./classes/admin_user.php";
     $user=new user();
     $user->backuser($_GET['id']);
     header("location:./listuserdeleted?msg=user back&type=success");
     exit;
?>