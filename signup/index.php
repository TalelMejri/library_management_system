<?php
    session_start();
    include "../classes/admin_user.php";
    include "../classes/File.php";
    $admin=new user();
   
    if(isset($_POST['signup'])){
        extract($_POST);
        $trouve=false;
        $AllCin=$admin->allcin();
      
        $file=new File("../storage/avatars",$_FILES['avatar']);
        if(empty($name)){
            header("location:index.php?msg=name required&type=danger");
        }
        else if(empty($email)){
            header("location:index.php?msg=email required&type=danger");
        }
        else if(empty($cin)){
            header("location:index.php?msg=cin required&type=danger");
        }
        else if(strlen($cin)<8){
            header("location:index.php?msg=cin should be 8 chiffres&type=danger");
        }else if($trouve==true)
        {
            header("location:index.php?msg=Cin Existe&type=danger");
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
            $verifier=$admin->signup($name,$email,$cin,$tlf,$password,$avatar);
                header("location:../login");
                exit;
            
        }
    }
    $show=true;
    $page_titel="Signup";
    $template="signup";
    include "../layout.phtml";
?>