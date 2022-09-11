<?php
if(!isset($_SESSION['userid'])){
    header("location:../login");
    exit;
}
    session_start();
    require_once("../classes/classes.php");
    $admin=new user();
    $book=new book();
    $books_favorite=$book->getbooksfavorite($_SESSION['userid']);
    $template="listfavoritebook";
    $page_titel="favorite";
    $show=null;
    include "../layout.phtml";
?>