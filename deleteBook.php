<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    if(!array_key_exists('id',$_GET)){
        header("location:../login");
        exit;
       }
    require_once("./classes/classes.php");
    $delete_book=new book();
    $delete_book->delete_book($_GET['id']);
    header("location:./consultebook?msg=delete succefuly&type=success");
    exit();
?>