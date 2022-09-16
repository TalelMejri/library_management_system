<?php 
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:../login");
        exit;
    }
    require_once("../classes/classes.php");
    $errors=[];

    if(isset($_POST['edit'])){
        extract($_POST);
       
        if(empty($name)){
            $errors[0]="name vide";
            goto show;
        }
        if(empty($email)){
            $errors[0]="email vide";
            goto show;
        }
        if(empty($password)){
            $errors[0]="password vide";
            goto show;
        }
        if(empty($tlf)){
            $errors[0]="email vide";
            goto show;
        }
        if(empty($cin)){
            $errors[0]="cin vide";
            goto show;
        }
      $avatarupload=false;
      $avatar="";
      if(strlen($_FILES['avatar']['names'])){
        $file=new File("../storage/avatars/",$_FILES['avatar']);
        $avatar="../storage/avatars/".$file->getfilename();
        if($file->upload()==false){
            $errors[0]="upload failed";
            goto show;
        }
        $avatarupload=true;
    }

        if(empty($errors)){
            $user=new user();
            $valid=$user->edituser($name,$email,$password,$tlf,$cin,$avatar,$_SESSION['userid'],$avatarupload);
            header("location:../profiluser");
            exit;
        }
    }
 
    show:
    $template ="edituser";
    $page_titel="Your Profil";
    $show=false;
    include "../layout.phtml";
?>