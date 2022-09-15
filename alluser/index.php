<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }

    require_once("../classes/classes.php");
    $user=new user();
    $page=isset($_GET['page']) ? $_GET['page'] : 1;
    $limit=isset($_GET['record']) ? $_GET['record'] :2 ;
    $next=$page < $user->countuser() /$limit ? $page+1 : 1;
    $previous= $page > 1 ? $page-1 : 1;
    $start=($page-1)* $limit;
    $alluser=$user->getalluser($limit,$start);
    $pages=ceil($user->countuser()/$limit);
    
    if(isset($_POST['btn_search'])){
        extract($_POST);
        $alluser=$user->getbyname($search);
    }
    
    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>