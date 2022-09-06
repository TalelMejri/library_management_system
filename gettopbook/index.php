<?php 
     require_once("../classes/classes.php");
    $book=new book();
    $books=$book->gettopratebook();
    require "gettopbook.phtml";
    ?>