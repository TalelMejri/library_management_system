<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:login.php");
        exit;
    }
include "./classes/File.php";
include "./classes/book_manager.php";

if(isset($_POST['update'])){
    extract($_POST);
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
}
    $book=new book();
    $books=$book->getbookbyid($_GET['id']);
    show_form:
    $show=null;
    $template="updatebook";
    $page_titel="Update book";
    include "./layout.phtml";
?>