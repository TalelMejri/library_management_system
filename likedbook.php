<?php

session_start();
include "./classes/admin_user.php";
$admin=new user();
if(isset($_POST['like'])){
    extract($_POST);
    $admin->AddLikedBook($_SESSION['userid'],$idbook);
   
}
header("location:./profiluser");
exit;
?>