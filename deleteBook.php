<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    include "./classes/book_manager.php";
    $delete_book=new book();
    $delete_book->delete_book($_GET['id']);
    header("location:./consultebook?msg=delete succefuly&type=success");
    exit();
?>