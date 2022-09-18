<?php 

 session_start();
 
 require_once("../classes/classes.php");
 // carte = [1,2,3] :[] 
 $carte = new carte();
 $admin=new user();
 $book=new book();
 $trouve=0;
 $book_click=$book->get_all_book();
 if(!isset($_SESSION['userid'])){
   header("location:../login");
   exit;
}
  if(isset($_POST['rate'])){
      extract($_POST);
      if($carte->verfier_rate_user($_SESSION['userid'],$idbook)==false){
         $book->addrate($_SESSION['userid'],$idbook,(int)$nombre); 
      }
  }

 if(isset($_POST['addcarte'])){
   extract($_POST);
  
   $nbr=(int)$quantity == 0 ? 1 : (int)$quantity;
   $carte->add_carte($idbook,$nbr);
 }

 if(isset($_GET['reset'])){
   $carte->clear_carte();
 }

 if(isset($_POST['delete'])){
   extract($_POST);
   $carte->remove($delete);
 }

 if(isset($_POST['save'])){
   extract($_POST);
   if($choisir=='livraison'){
      $choix=1;
   }else{
      $choix=0;
   }
   $carte->save($choix);
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
    $book_click=$book->get_all_book();
 }
 else if(isset($_POST['action'])){
    $book_click=$book->getbookbygenre('action');
 }
 else if(isset($_POST['adventure'])){
    $book_click=$book->getbookbygenre('adventure');
 }
 elseif(isset($_POST['mystery'])){
    $book_click=$book->getbookbygenre('mystery');
 }
 else if(isset($_POST['horror'])){
   $book_click=$book->getbookbygenre('horror');
}
else if(isset($_POST['story'])){
   $book_click=$book->getbookbygenre('story');
}

 $template="allbook_foruser";
 $page_titel="all BOOk";
 $show=null;
 include "../layout.phtml";

?>