<?php

include "../classes/admin_user.php";

$email = $_GET["key"];
$token = $_GET["token"];
$admin=new user();
$errors=[];
if(!$email || !$token){
    echo "Email or token missing";
    exit;
}else{
    $result = $admin->validateEmail($email,$token);
    if(!$result){
        $errors[0]="User doesn't exist";
        goto show;
    }else if ($result == 1){
        header("location:../login?verfiy=Your account has been verified avec succefully&color=success");
        exit;
    }
    else if ($result == 2 ){
        $errors[0]="Your account is already verified";
        goto show;
    }else if ($result == 3){
        $errors[0]="Something went wrong";
        goto show;
    }else if ($result == 4){
        $errors[0]="Token doesn't match email adress";
        goto show;
    }
    show:
    include 'verify.phtml';
}




