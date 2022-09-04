<?php 

 session_start();
 include "../classes/admin_user.php";
 include "../classes/book_manager.php";
 $admin=new user();
 $book=new book();
 $book_click=$book->get_all();
 if(isset($_POST['all'])){
    $book_click=$book->get_all();
 }
 if(isset($_POST['action'])){
    $book_click=$book->getbookbygenre('action');
 }
 if(isset($_POST['adventure'])){
    $book_click=$book->getbookbygenre('adventure');
 }
 if(isset($_POST['science'])){
    $book_click=$book->getbookbygenre('science');
 }
 $template="allbook_foruser";
 $page_titel="all BOOk";
 $show=null;
 include "../layout.phtml";

?>