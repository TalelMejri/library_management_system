<?php

    session_start();
    include "../classes/book_manager.php";
    $book=new book();
    $books_favorite=$book->getbooksfavorite($_SESSION['userid']);
    $template="listfavoritebook";
    $page_titel="favorite";
    $show=null;
    include "../auth_layout.phtml";
?>