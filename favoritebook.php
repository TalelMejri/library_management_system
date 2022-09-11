<?php

session_start();
require_once("./classes/classes.php");
$admin=new user();
if(!isset($_SESSION['userid'])){
    header("location:../login");
    exit;
}
if(isset($_POST['favorite'])){
    extract($_POST);
    $admin->AddfavoriteBook($_SESSION['userid'],$idbook);
}
if(isset($_POST['liked'])){
    header("location:./allbook_foruser");
    exit;
}
else if(isset($_POST['name_book'])){
    header("location:./listfavoritebook");
    exit;
}else{
header("location:./profiluser");
exit;
}


?>