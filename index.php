<?php
session_start();
if(!isset($_SESSION['lang'])){
    $_SESSION['lang']="en";
}
require_once "./languages/".$_SESSION['lang'].".php";
$errors=[];
$show = false;
$template="";
include "./layout.phtml";
?>