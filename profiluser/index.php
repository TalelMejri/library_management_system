<?php 
  session_start();
  if(!isset($_SESSION['userid'])){
      header("location:../layout.phtml");
      exit;
  }
  include "../classes/admin_user.php";
  include "../classes/book_manager.php";
  $admin=new user();
  $book=new book();
  $books=$book->getnewbok();
 
  $page_titel="Dashbord";
  $show=null;
  $template="profiluser";
  include "../layout.phtml";
?>