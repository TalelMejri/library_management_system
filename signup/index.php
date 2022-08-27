<?php
    session_start();
    include "../classes/admin_user.php";
    include "../classes/File.php";
    $admin=new user();

    if(isset($_POST['signup'])){
        extract($_POST);

        $file=new file("../storage/avatars",$_FILES['avatar']);
        if(empty($name)){
            header("location:index.php?msg=name required&type=danger");
        }
        else if(empty($email)){
            header("location:index.php?msg=email required&type=danger");
        }
        else if(empty($cin)){
            header("location:index.php?msg=cin required&type=danger");
        }
        else if(!is_int($cin)){
            header("location:index.php?msg=cin should be number&type=danger");
        }
        else if(strlen($cin)<8){
            header("location:index.php?msg=cin should be 8 chiffres&type=danger");
        }
        else if(empty($tlf)){
            header("location:index.php?msg=tlf required&type=danger");
        }
        else if(!is_int($tlf)){
            header("location:index.php?msg=tlf should be number&type=danger");
        }
        else if(strlen($tlf)<8){
            header("location:index.php?msg=tlf should be 8 chiffres&type=danger");
        }
        else if(empty($password)){
            header("location:index.php?msg=password required&type=danger");
        }
        else if(strln($password)<6){
            header("location:index.php?msg=password at least 6&type=danger");
        }
        else{
            
        }
    }

    
    $show=true;
    $page_titel="Signup";
    $template="signup";
    include "../layout.phtml";
?>