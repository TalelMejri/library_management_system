<?php
    session_start();
    include "./classes/db_connected.php";
    $a=new database();
    $page_titel="Accueil";
    $template="index";
    include "./layout.phtml";
?>