<?php 
 
 include "../classes/admin_user.php";
 use PHPMailer\PHPMailer\PHPMailer;
 include "../send.php";
 $admin=new user();

 if(isset($_POST['submit'])){

    extract($_POST);
    $user=$admin->checkEmail($email);
    if($user){
        if($user['verified']==1){
        $token_pass=rand(10,9999);
        $admin->addtoken($token_pass,$user['id']);
        sendmail("library",$email,"reset password","votre code : ".$token_pass."");
        header("location:../changerpassword");
        exit;
    }else{
        $error[0]="il faut verified";
        goto show;
        }
    }else{
        // user doesn't exist
        $error[0]="User Doesn't exit";
      
     
    }
 }

show:
 $template ="forgot";
 $page_titel = "Forgot password";
 $show = false;
 include "../auth_layout.phtml";
?>