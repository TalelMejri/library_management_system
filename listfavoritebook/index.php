<?php
 session_start();
if(!isset($_SESSION['userid'])){
    header("location:../login");
    exit;
}
   
    require_once("../classes/classes.php");
    $admin=new user();
    $book=new book();
    $carte=new carte();
    $books_favorite=$book->getbooksfavorite($_SESSION['userid']);
    $template="listfavoritebook";
    $page_titel="favorite";
    $show=null;
    include "../layout.phtml";
?>