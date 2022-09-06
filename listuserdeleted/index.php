<?php 
    session_start();
    require_once("../classes/classes.php");
    $user=new user();
    $alluser=$user->getalluserdeleted();
    $show=null;
    $template="listuserdeleted";
    $page_titel="all user deleted";
    include "../layout.phtml";
?>