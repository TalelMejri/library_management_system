<?php 
    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    require_once("../classes/classes.php");
    $trouve=0;
    $allcomments=new comment();
    if(array_key_exists('id',$_GET)){
        $allcomments->deletcommentsbyid($_GET['id']);
        echo "<script>alert('delete done ')</script>";
    }
    if(isset($_POST['save'])){
        $trouve=1;
        $search=$_POST['search'];
        $comments= $allcomments->getcommnetbyname($search);
        if($comments==false){
           $trouve=0;
        }
    }else{
        $comments=$allcomments->allmessages();
    }
    show:
    $show=null;
    $page_titel="comments";
    $template="allcomment";
    include "../layout.phtml";

?>