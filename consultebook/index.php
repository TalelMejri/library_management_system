<?php 
    session_start();
    if(!isset($_SESSION['name'])){
       header("location:../login");
       exit;
     }
    require_once("../classes/classes.php");
     $book=new book();
     if(isset($_POST['delete'])){
          $book->deleteallbook();
          echo "<script>alert('delete done')</script>";
     }

     $books=$book->get_all();
     if(isset($_POST['btn_search'])){
          extract($_POST);
          $books=$book->searchforbook($search);
     }
     if(isset($_GET['order_by_name'])){
          $books=$book->orderbyname();
     }
     $template="consultebook";
     $show=null;
     $page_titel="all book";
     include "../layout.phtml";
?>
