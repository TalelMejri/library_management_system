<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    require_once("../classes/classes.php");
     $errors=[];
    if(isset($_POST['submit'])){
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
        if(empty($confirm)){
            $errors[0]="confirm vide";
            goto show;
        }
        if($password!=$confirm){
            $errors[0]="confirm should egael password";
            goto show;
        }

        $avatarupload=false;
        $avatar="";
        if(strlen($_FILES['avatar']['names'])){
            $file=new File('../storage/personnel/',$_FILES['avatar']);
            $avatar='../storage/personnel/'.$file->getfilename();
          if($file->upload()==false){
              $errors[0]="upload failed";
              goto show;
          }
          $avatarupload=true;
      }

    if(empty($errors)){
        $admin=new user();
        $valid=$admin->edit_admin($name,$email,$password,$avatar,$_SESSION['id'],$avatarupload);
        header("location:../profiladmin");
        exit;
    }

    }
    show:
    $template ="editadmin";
    $page_titel="Your Profil";
    $show=false;
    include "../layout.phtml";
?>