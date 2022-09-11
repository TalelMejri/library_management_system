<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    require_once("../classes/classes.php");
    $user=new user();
    $alluser=$user->getalluserdeleted();
    $show=null;
    $template="listuserdeleted";
    $page_titel="all user deleted";
    include "../layout.phtml";
?>