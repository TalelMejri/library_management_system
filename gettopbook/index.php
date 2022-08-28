<?php 
    include "./classes/book_manager.php";
    $book=new book();
    $books=$book->gettopratebook();
    
    require "gettopbook.phtml";
    ?>