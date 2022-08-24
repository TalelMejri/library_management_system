<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:login.php");
        exit;
    }
        include "./classes/File.php";
        include "./classes/book_manager.php";
        $book=new book();
    if(isset($_POST['update'])){
     
     extract($_POST);
     $file=new File('./storage/book/',$_FILES['avatar']);
     $avatar="./storage/book/".$file->getfilename();
     if(empty($errors)){
         $new=$book->updatebook($name_book,$author,$description,$nbr,$avatar,$idbook);
        header("location:consultebook.php");
        exit;
    }
}
    $books=$book->getbookbyid(array_key_exists('id',$_GET) ? $_GET['id'] : $_POST['id']);
    show_form:
    $show=null;
    $template="updatebook";
    $page_titel="Update book";
    include "./layout.phtml";
?>