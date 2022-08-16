<?php
    session_start();
    include "./classes/db_connected.php";
    $a=new database();
    $page_titel="Accueil";
    $page_concerner="index.php";
    include "./layout.phtml";
?>