<?php 

session_start();
require_once "../classes/classes.php";
$admin=new user();
$chat=new chat();
$a=false;
if(!isset($_SESSION['userid'])){
    header("location:../login");
    exit;
}

$all_user=$admin->get_user_chat($_SESSION['userid']);

if(isset($_SESSION['userid'])){

}

if(isset($_GET['id'])){
 extract($_POST);
 $user_choice=$admin->getuserbyid($_GET['id']);
}

if(isset($_POST['send'])){
    extract($_POST);
    $user_choice=$admin->getuserbyid($id);
    $chat->send_message($_SESSION['userid'],$id,$message);
}

$template="message";
$page_titel="Chat";
$show=null;
include "../layout.phtml";
?>