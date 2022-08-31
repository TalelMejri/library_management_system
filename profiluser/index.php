<?php 
  session_start();
  if(empty($_SESSION['userid'])){
      header("location:../layout.phtml");
      exit;
  }

  $page_titel="Dashbord";
  $show=null;
  $template="profiluser";
  include "../layout.phtml";
?>