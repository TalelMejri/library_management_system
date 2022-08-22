<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:login.php");
        exit;
    }
    include "./classes/comments_manager.php";

    $allcomments=new comment();
    $comments=$allcomments->allmessages();
    $show=null;
    $page_titel="comments";
    $template="allcomment";
    include "layout.phtml";

?>