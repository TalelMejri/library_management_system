<?php 

    session_start();
    include "../classes/admin_user.php";
    $user=new user();
    $getuser=$user->getuserbyid($_GET['id']);
    $template='detailsuser';
    $page_titel="detail user";
    $show=false;
    include "../layout.phtml";

?>