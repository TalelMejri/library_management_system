<?php 

 session_start();
 
 require_once("../classes/classes.php");
 // carte = [1,2,3] :[] 
 $carte = new carte();
 $admin=new user();
 $book=new book();
 $trouve=0;
 $book_click=$book->get_all();

 if(isset($_POST['addcarte'])){
   extract($_POST);
   $carte->add_carte($idbook);
 }

 if(isset($_GET['reset'])){
   $carte->clear_carte();
 }

 if(isset($_POST['delete'])){
   extract($_POST);
   $carte->remove($delete);
 }

 if(isset($_POST['save'])){
   $carte->save();
 }
 if(isset($_POST['btn_search'])){
    $trouve=1;
    $search=$_POST['search'];
    $book_click= $book->searchforbook($search);
    if($book_click==false){
       $trouve=0;
    }
}
 else if(isset($_POST['all'])){
    $book_click=$book->get_all();
 }
 else if(isset($_POST['action'])){
    $book_click=$book->getbookbygenre('action');
 }
 else if(isset($_POST['adventure'])){
    $book_click=$book->getbookbygenre('adventure');
 }
 elseif(isset($_POST['science'])){
    $book_click=$book->getbookbygenre('science');
 }

 $template="allbook_foruser";
 $page_titel="all BOOk";
 $show=null;
 include "../layout.phtml";

?>