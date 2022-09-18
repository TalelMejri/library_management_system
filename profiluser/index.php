<?php 
  session_start();
  if(!isset($_SESSION['userid'])){
      header("location:../layout.phtml");
      exit;
  }
  require_once("../classes/classes.php");
  $admin=new user();
  $book=new book();
  $carte=new carte();
  $books=$book->getBookfavoris($_SESSION['userid']);
 
  //exit;
 
  $page_titel="Dashbord";
  $show=null;
  $template="profiluser";
  include "../layout.phtml";
?>