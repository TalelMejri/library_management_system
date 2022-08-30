<?php 
 
 include "../classes/admin_user.php";
 use PHPMailer\PHPMailer\PHPMailer;
 include "../send.php";

 $admin=new user();
 if(isset($_POST['submit'])){
    extract($_POST);
    $user=$admin->checkEmail($email);
    $token=$user['token'];
    $link="<a href='".$_SERVER['HTTP_HOST']."/".explode('/',$_SERVER['PHP_SELF'])[1]."/verify/index.php?key=".$email."&token=".$token."'>Cliquer pour renvoyer token</a>";
    $verfier=sendmail("library",$email,"Renvyoer verification","cliquer ici pour verification encore'.$link.'");
    header("location:../login?mesage_renvoyer=Email de verification renvoyé&mesage_renvoyer1=Veuillez vérifier votre e-mail pour le confirmer&typ=success");
    exit;
}
 include "./revoyer.phtml";
?>