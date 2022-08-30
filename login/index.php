<?php 
    
    include "../classes/admin_user.php";
    session_start();
    if(isset($_POST['submit'])){
        include "../utilities.php";

        extract($_POST);

        if(empty($email) && empty($password)){
            header("location:index.php?msg=All filed is empty&type=danger");
        }

        else if(empty($email)){
            header("location:index.php?msg=email is required&type=danger");
        }

        else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            header("location:index.php?msg=email is invalid&type=danger");
        }

         else if(empty($password)){
            header("location:index.php?msg=password is required&type=danger");
        }
        else {
            $user=new user();
            $verifier_admin=$user->login_admin($email,$password);
            $verifier_user=$user->login_user($email,$password);
            if($verifier_admin==false &&  $verifier_user==0){
               header("location:index.php?msg=password or email is incorrect&type=danger");
            }
            else if($verifier_user==2){
                $link="<a href='../renvoyerEmail'>cliquer Here for renvoyer</a>";
                header("location:index.php?msg=account is not verified " .$link." &type=danger");
                exit;
             }
            else if($verifier_user==1){
                header("location:../profiluser");
                exit;
            }else if($verifier_admin==true){
                header("location:../profiladmin");
                exit;
            }
        }
        
    }
    $show=true;
    $page_titel="login";
    $template="login";
    include "../layout.phtml";
?>