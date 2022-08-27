<?php
    session_start();
    include "../classes/admin_user.php";
    include "../classes/File.php";
    $admin=new user();

    if(isset($_POST['signup'])){
        
    }

    
    $show=true;
    $page_titel="Signup";
    $template="signup";
    include "../layout.phtml";
?>