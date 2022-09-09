<?php 

session_start();
require_once "../classes/classes.php";

$admin=new user();
$all_user=$admin->get_user_chat();
$template="message";
$page_titel="Chat";
$show=null;
include "../layout.phtml";
?>