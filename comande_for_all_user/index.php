<?php 
 
  session_start();
  include "../classes/classes.php";
  $book=new book();
  $commandes=$book->allcommandeinadmin();
   
   $template="allcommandeinadmin";
   $page_titel="ALL commande";
   $show=null;
   include "../layout.phtml";
?>