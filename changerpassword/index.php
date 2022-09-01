<?php

 include "../classes/admin_user.php";
 $admin=new user();
 $suivant=1;

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
       }
    }

    if(isset($_POST['update'])){
           $suivant=0;
           extract($_POST);
           $admin->changerpassword($id,$password);
           header("location:../login");
           exit;
       }
      
$template ="changerpassword";
$page_titel = "Change password";
$show = false;
include "../auth_layout.phtml";
//  include "./changerpassword.phtml";

?>