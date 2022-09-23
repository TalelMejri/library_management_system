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
    $commande_checked=$book->all_line_commande_by_id($idcommande);
    $user_client=$book->check_info_user($idcommande);
    $pdf->AddPage();
    $pdf->SetFont('Arial','',16);
    $pdf->cell(0,20,"Votre Facture ". $user_client['name'],1,0,'C');
    $pdf->Cell(59 ,30,'',0,1);
    $pdf->cell(59,5,"Library Mejri",0,0);
    $pdf->cell(50,0,"",0,0);
    $pdf->cell(0,5,"Details facture :",0,1);
    $pdf->SetFont('Arial','',10);
    $pdf->cell(110,7,"bahra Elkef",0,0);
    $pdf->cell(22,7,"Customer Id :",0,0);
    $pdf->cell(30,7,$user_client['id'],0,1);
    $pdf->cell(110,7,"bahra 7716",0,0);
    $pdf->cell(23,7,"Facture Date :",0,0);
    $pdf->cell(22,7,date('Y/m/d'),0,1);
    $pdf->cell(110,7,"",0,0);
    $pdf->cell(20,7,"Facture No",0,0);
    $pdf->cell(10,7,"####",0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Ln();
    $pdf->Cell(220 ,10,'',0,1);
    $pdf->Cell(50,10,'',0,1);    
    $pdf->Cell(15,10,"#",1,0,'C');
    $pdf->Cell(70,7,"name book",1,0,'C');
    $pdf->Cell(30,7,"Quantity",1,0,'C');
    $pdf->Cell(30,7,"Unit Price",1,0,'C');
    $pdf->Cell(30,7,"Total",1,1,'C');/*end of line*/
    $total=1;
    $i=0;
    $total_commande=0;
    $livraison=0;
    foreach($commande_checked as $value){
      $i++;
      $total=($value['quantity']*$value['Prix']);
      $pdf->SetFont('Arial','',8);
      $pdf->Cell(15,7,$i,1,0,'C');
      $pdf->Cell(70,7,$value['name_book'],1,0,'C');
      $pdf->Cell(30,7,$value['quantity'],1,0,'C');
      $pdf->Cell(30,7,$value['Prix'],1,0,'C');
      if($value['aveclivraison']){
        $livraison=7.500;
      }else{
        $livraison=0.00;
      }
      $pdf->Cell(30,7,$total,1,1,'C');
      $total_commande+=$total;
    }
    $pdf->Cell(125,6,"",0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,7,"livraison",0,0,'C');
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(30,7,$livraison,1,1,'C');
    $pdf->Cell(120,6,"",0,0);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(25,7,"Total",1,0,'C');
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(30,7,$total_commande+$livraison." dt",1,0,'C');
    $pdf->setY(-35);
    $pdf->Cell(0,0,"Nous apprecions votre clinetele,",0,0,'C');
    $pdf->setY(-30);
    $pdf->Cell(0,0,"si vous-avez des questions sur cette facture,n hesitez pas a nous contacter.",0,0,'C');
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