<?php

    session_start();
    session_destroy();
    unset($_SESSION['name']);
    unset($_SESSION['user_name']);
    header ('location:login.php');
?>