<?php 

    session_start();
    if(!isset($_SESSION['userid']) && !isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }

    require_once("../classes/classes.php");
    $user=new user();
    $getuser=$user->getuserbyid($_GET['id']);
    $template='detailsuser';
    $page_titel="detail user";
    $show=false;
    include "../layout.phtml";

?>