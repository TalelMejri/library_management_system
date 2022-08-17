<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:login.php");
        exit;
    }
include "./classes/File.php";
include "./classes/book_manager.php";
$errors=[];
if(isset($_POST['submit'])){
    extract($_POST);
 /*   echo "<pre>";
    print_r($_FILES);
    echo '</pre>';
    exit;*/
    $file=new File('./storage/book/',$_FILES['avatar']);

    if(empty($name_book)){
        $errors[0]="name book required";
        goto show_form;
    }

    if(empty($author)){
        $errors[0]="author required";
        goto show_form;
    }

    if(empty($description)){
        $errors[0]="description required";
        goto show_form;
    }

    if(empty($nbr)){
        $errors[0]="nombre required";
        goto show_form;
    }

    /*if(empty($_FILES['avatar'])){
        $errors[0]="avatar required";
        goto show_form;
    }*/
    
    if($file->upload()==false){
        $errors[0]="upload failed !!!";
        goto show_form;
    }

    if($file->isimage()==false){
        $errors[0]="upload image !!!";
        goto show_form;
    }

    if(!$file->size_file()){
        $errors[0]="upload image smaller than 1Mb !!!";
        goto show_form;
    }

    $avatar="./storage/book/".$file->getfilename();
    if(empty($errors)){
        $user=new book();
        $verifie_add=$user->add_book($name_book);
        if(!is_int($verifie_add)){
            $errors[0]=$verifie_add;
        }else{
            header("location:profil_admin.php");
            exit;
        }
    }
}
    show_form:
    $template="addbook";
    $page_titel="add book";
    include "./layout.phtml";
?>