<?php 

 session_start();
 include "../classes/admin_user.php";
 include "../classes/book_manager.php";
 $admin=new user();
 $book=new book();
 $trouve=0;
 $book_click=$book->get_all();
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