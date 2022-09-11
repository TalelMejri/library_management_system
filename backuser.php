<?php 
     session_start();
     if(!isset($_SESSION['name'])){
          header("location:../login");
          exit;
      }
     require_once("./classes/classes.php");
     $user=new user();
     $user->backuser($_GET['id']);
     header("location:./listuserdeleted?msg=user back&type=success");
     exit;
?>