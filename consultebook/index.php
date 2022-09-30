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

     $limit=isset($_GET['show_book']) ? $_GET['show_book'] : 5;
     $page=isset($_GET['page']) ? $_GET['page'] : 1;
     $choix_order=isset($_GET['choix']) ? $_GET['choix'] : '';
     $pages=ceil($book->count_book()/$limit);
     $start=($page -1 )* $limit;
     $next=$page+1 < $pages ? $page+1 : $pages;
     $previous=($page>1) ? $page-1 : 1;
     $books=$book->get_all($limit,$start,$choix_order);
     if(isset($_POST['btn_search'])){
          extract($_POST);
          $books=$book->searchforbook($search);
     }
     
     $template="consultebook";
     $show=null;
     $page_titel="all book";
     include "../layout.phtml";
?>
