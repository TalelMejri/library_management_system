<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:./login");
        exit;
    }
    if(!array_key_exists('id',$_GET)){
        header("location:./login");
        exit;
    }
    include "./classes/classes.php";
    $notif=new notification();
    $notif->deleetbyid($_GET['id']);
    header("location:./profiladmin");
    exit;
?>