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
    if($number_all_book>0){
    $pourcentage_book_issue= round( $number_book_not_enable*100/$number_all_book,2);
    $pourcentage_book_enable=round(100-$pourcentage_book_issue,2);
    }else{
        $pourcentage_book_issue=0;
        $pourcentage_book_enable=0;
    }

    $page_titel="Accueil";
    $show=null;
    $template="profil_admin";
    include "./layout.phtml";
?>