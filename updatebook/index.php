<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }

     if(!(array_key_exists('id',$_GET) or array_key_exists('idbook',$_POST)) and !(ctype_digit($_GET['id']) or ctype_digit($_POST['idbook']))){
         header("location:../consultebook");
        exit();
    } 

        include "../classes/File.php";
        include "../classes/book_manager.php";
        
    $book=new book();  
    $errors=[];  
    if(isset($_POST['update'])){
     extract($_POST);
     $file=new File('../storage/book/',$_FILES['avatar']);
     $file->upload();
     $avatar="../storage/book/".$file->getfilename();
     if(empty($errors)){
        $idbook = array_key_exists('id',$_GET) ? $_GET['id'] : $_POST['idbook'];
        $new=$book->updatebook($idbook,$name_book,$author,$description,$nbr,$avatar);
        header("location:../consultebook");
        exit;
    }
}

    $books=$book->getbookbyid(array_key_exists('id',$_GET) ? $_GET['id'] : $_POST['idbook']);
    show_form:
    $show=null;
    $template="updatebook";
    $page_titel="Update book";
    include "../index.php";
?>