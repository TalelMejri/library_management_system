<?php
    session_start();
    if(empty($_SESSION['name'])){
        header("location:layout.phtml");
        exit;
    }
    include "./classes/book_manager.php";
    $a=new book();
    $number_all_book=$a->count_books();
    $enable='enable';
    $number_book_enable=$a->nombre_books_enabel_or_not($enable);
    $not_enable='not_enable';
    $number_book_not_enable=$a->nombre_books_enabel_or_not($not_enable);
    $page_titel="Accueil";
    $profil=true;
    $template="profil_admin";
    include "./layout.phtml";
?>