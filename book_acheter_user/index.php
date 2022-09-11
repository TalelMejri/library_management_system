<?php 
   session_start();
   if(!isset($_SESSION['userid'])){
      header("location:../login");
      exit;
  }
   require_once ("../classes/classes.php");
   $book=new book();
   $commande=$book->getcommande_user($_SESSION['userid']);
   $template="book_acheter_user";
   $page_titel="Book payer";
   $show=null;
   include "../layout.phtml";

?>