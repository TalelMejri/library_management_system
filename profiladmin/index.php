<?php
    session_start();
    if(empty($_SESSION['name'])){
        header("location:../layout.phtml");
        exit;
    }

    require_once("../classes/classes.php");
    $book=new book();
   
    $number_book_enable= $book->nombre_books_enable();
    $number_book_not_enable= $book->nombre_books_not_enable();
    $number_all_book=$number_book_enable+$number_book_not_enable;
    if($number_all_book>0){
       $pourcentage_book_issue= round($number_book_not_enable*100/$number_all_book,2);
       $pourcentage_book_enable=round(100-$pourcentage_book_issue,2);
    }else{
        $pourcentage_book_issue=0;
        $pourcentage_book_enable=0;
    }
    

    $last=new comment();
    $lastmessage=$last->getlastmessage();
    $page_titel="Dashbord";
    $show=null;
    $template="profil_admin";
    include "../layout.phtml";
?>