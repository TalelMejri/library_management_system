<?php 
    
    include "./classes/admin_user.php";
    session_start();
    if(isset($_POST['submit'])){
        include "./utilities.php";

        extract($_POST);

        if(empty($email) && empty($password)){
            header("location:login.php?msg=All filed is empty&type=danger");
        }

         if(empty($email)){
            header("location:login.php?msg=email is required&type=danger");
        }

          /*if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            header("location:login.php?msg=email is invalid&type=danger");
        }*/

         if(empty($password)){
            header("location:login.php?msg=password is required&type=danger");
        }
        else {
            $user=new user();
            $verifier=$user->login_admin($email,$password);
            if($verifier==false){
               header("location:login.php?msg=password or email is incorrect&type=danger");
            }else{
                header("location:index.php");
                exit;
            }
        }
        
    }

    $page_titel="login";
    $template="login";
    include "./layout.phtml";
?>