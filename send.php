<?php
use PHPMailer\PHPMailer\PHPMailer;

function sendmail($name,$email,$subject,$message,$file_name=null){
/* Envoi de mail */
    /*verification que champs nom et email sont non null */
    /* remplissage des variables avec les champs des form */
    /* integration des fichiers phpmailer */
    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";
    $mail=new PHPMailer();
    /* parametres SMTP */
    $mail->isSMTP();                            //envoyer utilisant SMTP
    $mail->Host="smtp.gmail.com";                //initialization de serveur SMTP
    $mail->SMTPAuth=true;                       //activation SMTP authentification
    $mail->Username="testlibrary05@gmail.com";  //ADRESSE SMTP
    $mail->Password="ctafgykbzriltxvu";           //Mot de passe SMTP
    $mail->Port=465;                            //Port TCP
    $mail->SMTPSecure="ssl";
    /* Contenu De mail de ADMIN*/
    $mail->isHTML(true);                                        //Format de mail html
    $mail->setFrom("testlibrary05@gmail.com",$name);
    $mail->addAddress("$email");               //Adresse reception
    $mail->Subject=("$subject");                       //Le sujet de l'email
    $mail->Body=$message;     
   if($file_name!=null){                                   //Le contenu de mail
      $mail->addAttachment("../comande_for_all_user/facture/".$file_name);
   }
    /* Commande pour envoyer le mail */
    if ($mail->send())
        return 1;
    else   
        return $mail->ErrorInfo;
    }
?>
