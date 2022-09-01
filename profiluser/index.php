<?php 
  session_start();
  if(!isset($_SESSION['userid'])){
      header("location:../layout.phtml");
      exit;
  }

  include "../classes/book_manager.php";

  $book=new book();
  $books=$book->getnewbok();

  $page_titel="Dashbord";
  $show=null;
  $template="profiluser";
  include "../layout.phtml";
?>