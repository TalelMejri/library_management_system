<?php 
    session_start();
    include "../classes/admin_user.php";
    $user=new user();
    $alluser=$user->getalluserdeleted();
    $show=null;
    $template="listuserdeleted";
    $page_titel="all user deleted";
    include "../layout.phtml";
?>