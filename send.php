<?php
use PHPMailer\PHPMailer\PHPMailer;

function sendmail($name,$email,$subject,$message){
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
    $mail->Username="librarymejri@gmail.com";  //ADRESSE SMTP
    $mail->Password="airdxstolhkmwqio";           //Mot de passe SMTP
    $mail->Port=465;                            //Port TCP
    $mail->SMTPSecure="ssl";
    /* Contenu De mail de ADMIN*/
    $mail->isHTML(true);                                        //Format de mail html
    $mail->setFrom("librarymejri@gmail.com",$name);
    $mail->addAddress("$email");               //Adresse reception
    $mail->Subject=("$subject");                       //Le sujet de l'email
    $mail->Body=$message;                                       //Le contenu de mail
    
    /* Commande pour envoyer le mail */
    if ($mail->send())
        return 1;
    else   
        return $mail->ErrorInfo;
    }
?>
