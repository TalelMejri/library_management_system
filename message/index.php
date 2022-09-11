<?php 

session_start();
require_once "../classes/classes.php";
$admin=new user();
$chat=new chat();
$a=false;
if(!isset($_SESSION['userid']) && !isset($_SESSION['name'])){
    header("location:../login");
    exit;
}

if(isset($_SESSION['userid'])){
    $all_user=$admin->get_user_chat($_SESSION['userid']);
}else if(isset($_SESSION['name'])){
    $all_user=$admin->get_user_chat($_SESSION['id']);
}

if(isset($_GET['id'])){
 extract($_POST);
 $user_choice=$admin->getuserbyid($_GET['id']);
}

if(isset($_POST['send'])){
    extract($_POST);
    $user_choice=$admin->getuserbyid($id);
    if(isset($_SESSION['userid'])){
        $chat->send_message($_SESSION['userid'],$id,$message);
    }else if(isset($_SESSION['name'])){
        $chat->send_message($_SESSION['id'],$id,$message);
    }
 
}

$template="message";
$page_titel="Chat";
$show=null;
include "../layout.phtml";
?>