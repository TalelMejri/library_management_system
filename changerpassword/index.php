<?php

 include "../classes/admin_user.php";
 $admin=new user();
 $token=array_key_exists('token_check',$_GET)? $_GET['token_check'] : $_POST['token'];

 if(isset($_POST['update'])){
    if(!empty($password) && !empty($confirme) && ($password==$confirme)){
        //$admin->changerpassword($token,$password);
        header("location:../login");
        exit;
    }else{
        echo "error";
    }
 }
 include "./changerpassword.phtml";

?>