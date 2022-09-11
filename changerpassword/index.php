<?php

 require_once("../classes/classes.php");
 $suivant=1;
 $admin=new user();
 $error=[];
 if(isset($_POST['confirmer'])){  
       $suivant=0; 
       extract($_POST);
       $user = new User();
       $verify = $user->checkToken($email,$code);
       $id=$verify['id'];
       if ($verify){
              $suivant=0; 
       }else{
          echo "<script>alert('Please check the code or the email');</script>";
          $suivant=1;
       }
    }

    if(isset($_POST['update'])){
           $suivant=0;
           extract($_POST);
           if(!empty($password) && !empty($confirme) && ($password==$confirme)){
           $admin->changerpassword($id,$password);
           header("location:../login");
           exit;
       }else{
              $error[0]="check passowrd or confirme password";
              goto show;
       }
   }
show:
$template ="changerpassword";
$page_titel = "Change password";
$show = false;
include "../auth_layout.phtml";
//  include "./changerpassword.phtml";
?>