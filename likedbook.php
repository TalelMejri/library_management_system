<?php

session_start();
require_once("./classes/classes.php");
if(!isset($_SESSION['userid'])){
    header("location:../login");
    exit;
}
$admin=new user();
$notif=new notification();
if(isset($_POST['like'])){
    extract($_POST);
    $admin->AddLikedBook($_SESSION['userid'],$idbook);
    $message=$_SESSION['username']." like book ".$name;
    if(!$verified){
        $notif->addnotifi($message);
    }
}
if(isset($_POST['liked'])){
    header("location:./allbook_foruser");
    exit;
}
else{
header("location:./profiluser");
exit;
}
?>