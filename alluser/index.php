<?php 
    session_start();
    include "../classes/admin_user.php";
    $user=new user();
    $alluser=$user->getalluser();
    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>