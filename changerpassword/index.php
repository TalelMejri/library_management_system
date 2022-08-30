<?php

 include "../classes/admin_user.php";
 $admin=new user();
 $token=$_GET['token_check'];
        $password=$_POST['password'];
        $admin->changerpassword($token,$password);
        header("location:../login");
        exit;
 include "./changerpassword.phtml";

?>