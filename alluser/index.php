<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    
    require_once("../classes/classes.php");
    $user=new user();
    $pages=isset($_GET['page']) ? $_GET['page'] : 1;
    $limit=isset($_POST['choix']) ? $_POST['choix'] :10;
    $alluser=$user->getalluser($limit);
    $pages=ceil($user->countuser()/$limit);
    
    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>