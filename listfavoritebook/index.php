<?php

    session_start();
    include "../classes/admin_user.php";
    include "../classes/book_manager.php";
    $admin=new user();
    $book=new book();
    $books_favorite=$book->getbooksfavorite($_SESSION['userid']);
    $template="listfavoritebook";
    $page_titel="favorite";
    $show=null;
    include "../layout.phtml";
?>