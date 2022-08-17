<?php
    session_start();
    include "./classes/book_manager.php";
    $a=new book();
    $number=$a->count_books();
    $page_titel="Accueil";
    $template="profil_admin";
    include "./layout.phtml";
?>