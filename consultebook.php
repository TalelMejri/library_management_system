<?php 
    session_start();
    include "./classes/book_manager.php";
    $book=new book();
    $books=$book->get_all();
    $template="consultebook";
    $page_titel="all book";
    include "./layout.phtml";
?>
