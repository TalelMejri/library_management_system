<?php

session_start();
include "./classes/admin_user.php";
$admin=new user();
if(isset($_POST['favorite'])){
    extract($_POST);
    $admin->AddfavoriteBook($_SESSION['userid'],$idbook);
}
header("location:./profiluser");
exit;
?>