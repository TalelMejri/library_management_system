<?php

include "../classes/admin_user.php";

$email = $_GET["key"];
$token = $_GET["token"];
$admin=new user();
if(!$email || !$token){
    echo "Email or token missing";
    exit;
}else{
    $result = $admin->validateEmail($email,$token);
    if(!$result){
        echo "User doesn't exist";
        exit;
    }else if ($result == 1){
        echo "jawna behi";
        exit;
    }
    else if ($result == 2 ){
        echo "Your account is already verified";
        exit;
    }else if ($result == 3){
        echo "Something went wrong";
        exit;
    }else if ($result == 4){
        echo "Token doesn't match email adress";
        exit;
    }
}




