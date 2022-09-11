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
     $template="consultebook";
     $show=null;
     $page_titel="all book";
     include "../layout.phtml";
?>
