<?php 

    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    $error=[];
    require_once("../classes/classes.php");
    $user=new user();
    $page=isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1 ;
    $limit=isset($_GET['record']) && is_numeric($_GET['record']) ? $_GET['record'] : 5 ;

    $next=$page < $user->countuser() /$limit ? $page+1 : 1 ;
    $previous= $page > 1 ? $page-1 : 1 ;
    $start=($page-1)* $limit;
    $pages=ceil($user->countuser()/$limit);
    if(isset($_GET['search']) && !empty($_GET['search'])){
        extract($_GET);
        if(isset($_GET['btn_search'])){
            if(empty($search)){
                $error['search']="field empty";
            }
        }
        $alluser=$user->getbyname($search,$limit,$start);
        if(!$alluser){
            $alluser="vide";
        }
        $pages=ceil($user->countusersearch($search)/$limit);
        $next=$page < $user->countusersearch($search) / $limit ? $page+1 : 1 ;
        $previous= $page > 1 ? $page-1 : 1 ;
    }else{
        $alluser=$user->getalluser($limit,$start);
    }

    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>