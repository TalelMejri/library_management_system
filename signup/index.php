<?php
    session_start();
    include "../classes/admin_user.php";
    include "../classes/File.php";
    include "../send.php";
    use PHPMailer\PHPMailer\PHPMailer;
    $admin=new user();
   
    if(isset($_POST['signup'])){
        extract($_POST);
        $trouve=false;
        $file=new File("../storage/avatars/",$_FILES['avatar']);
        $verifierEmail=$admin->checkEmail($email);
        $verifierCin=$admin->checkCin($cin);
       
        if(empty($name)){
            header("location:index.php?msg=name required&type=danger");
        }
        else if(empty($email)){
            header("location:index.php?msg=email required&type=danger");
        }else if($verifierEmail){
            header("location:index.php?msg=Email existe&type=danger");
        }
        else if(empty($cin)){
            header("location:index.php?msg=cin required&type=danger");
        }
        else if(strlen($cin)<8){
            header("location:index.php?msg=cin should be 8 chiffres&type=danger");
        }else if($verifierCin){
            header("location:index.php?msg=cin Existe&type=danger");
        }
        else if(empty($tlf)){
            header("location:index.php?msg=tlf required&type=danger");
        }
        else if(strlen($tlf)<8){
            header("location:index.php?msg=tlf should be 8 chiffres&type=danger");
        }
        else if(empty($password)){
            header("location:index.php?msg=password required&type=danger");
        }
        else if(strlen($password)<6){
            header("location:index.php?msg=password at least 6&type=danger");
        }
        else if($file->upload()==false){
            header("location:index.php?msg=image not uploaded&type=danger");
        }else{
            $avatar="../storage/avatars/".$file->getfilename();
            $token =md5($cin).rand(10, 9999);
            $verifier=$admin->signup($name,$email,$cin,$tlf,$password,$avatar,$token);
            $link = "<a href='".$_SERVER['HTTP_HOST']."/".explode('/',$_SERVER['PHP_SELF'])[1]."/verify/index.php?key=" . $email . "&token=" .$token."'>Click and Verify Email</a>";
            sendmail("library", $email, "Lien de Verification", "Cliquez sur ce lien pour vérifier l'e-mail '.$link.'");
            header("location:../login");
        }
    }
    $show=true;
    $page_titel="Signup";
    $template="signup";
    include "../layout.phtml";
?>