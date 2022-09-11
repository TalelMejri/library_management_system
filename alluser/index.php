<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    require_once("../classes/classes.php");
    $user=new user();
    $alluser=$user->getalluser();
    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>