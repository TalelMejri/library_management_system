<?php 
 
 include "../classes/admin_user.php";
 use PHPMailer\PHPMailer\PHPMailer;
 include "../send.php";
 $admin=new user();
 $suivant=0;
 if(isset($_POST['submit'])){
    $suivant=1;
    extract($_POST);
    $user=$admin->checkEmail($email);
    if($user){
        if($user['verified']==1){
        $token_pass=rand(10,9999);
        $token=$token_pass;
        $admin->addtoken($token_pass,$user['id']);
        sendmail("library",$email,"reset password","votre code : ".$token_pass."");
        $suivant=1;
    }else{
            echo "il faut verified";
        }
    }
 }

 if(isset($_POST['confirmer'])){   
    $token=$_GET['token'];
    extract($_POST);
    if($code==$token){
        header("location:../changerpassword?token_check=".$token."");
        exit;
    }else{
        $suivant=1;
        echo "no";
    }
 }

 include "./forgot.phtml"
?>