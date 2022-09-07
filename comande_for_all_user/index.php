<?php 
 
  session_start();
  include "../classes/classes.php";
  $book=new book();
  $commandes=$book->allcommandeinadmin();

  if(isset($_POST['valider'])){
    extract($_POST);
    $book->updatevalider($idcommande,$idbook,$quantity);
  }

  if(isset($_POST['rejeter'])){
    extract($_POST);
    $book->deletecommande($idcommande);
  }

   $template="comande_for_all_user";
   $page_titel="ALL commande";
   $show=null;
   include "../layout.phtml";
?>