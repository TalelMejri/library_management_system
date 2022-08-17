<?php
    session_start();
    include "./classes/db_connected.php";
    $a=new database();
    $page_titel="Accueil";
    $template="profil_admin";
    include "./layout.phtml";
?>