<?php 
    session_start();
    require_once("../classes/classes.php");
    $user=new user();
    $alluser=$user->getalluser();
    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>