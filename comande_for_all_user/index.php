<?php 
 
  session_start();
  if(!isset($_SESSION['name'])){
    header("location:../login");
    exit;
  }
  include "../classes/classes.php";
  ob_start();
  require "../fpdf/fpdf.php";
  use PHPMailer\PHPMailer\PHPMailer;
  require_once "../PHPMailer/PHPMailer.php";
  require_once "../PHPMailer/SMTP.php";
  require_once "../PHPMailer/Exception.php";
  $mail=new PHPMailer();
  include "../send.php";
  $pdf=new FPDF();
  $book=new book();
  $user=new user;

  $commandes=$book->allcommandeinadmin();

  if(isset($_POST['valider'])){
    extract($_POST);
    $book->updatevalider($idcommande,$idbook,$quantity);
    $user_client=$book->check_info_user($idcommande);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',16);
    $pdf->SetTextColor(1,0,0);
    $pdf->cell(0,20,"Votre Facture",1,0,'C');
    $file_name=$user_client['name'].rand(10,9999).".pdf";
    $file=$pdf->Output(dirname(__FILE__)."./facture/".$file_name,"F");
    //$file=$pdf->Output("../facture/".$file_name,"F");
    //file_put_contents($file_name,$file);
    sendmail("library",$user_client['email'],"Facture","votre facture",$file_name);
    ob_end_flush(); 
  }

  if(isset($_POST['rejeter'])){
    extract($_POST);
    $book->deletecommande($idcommande);
  }

   $template="comande_for_all_user";
   $page_titel="ALL commande";
   $show=null;
   include "../layout.phtml";
?>