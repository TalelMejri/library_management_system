<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:login.php");
        exit;
    }
    include "./classes/comments_manager.php";
    $trouve=0;
    $allcomments=new comment();
    if(isset($_POST['save'])){
        $trouve=1;
        $search=$_POST['search'];
        $comments= $allcomments->getcommnetbyname($search);
        if($comments==false){
           $trouve=0;
        }
    }else{
        $comments=$allcomments->allmessages();
    }
    show:
    $show=null;
    $page_titel="comments";
    $template="allcomment";
    include "layout.phtml";

?>