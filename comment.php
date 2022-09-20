<?php
   session_start();
   require_once("./classes/classes.php");
   include "./send.php";
    use PHPMailer\PHPMailer\PHPMailer;
    $errors=[];
    if(isset($_POST['submit'])){
        extract($_POST);
        if(empty($name)){
            $errors['name']="name required";
            goto shoform;
        }
        else if(empty($email)){
            $errors['email']="email required";
            goto shoform;
        }
        else if(empty($messages)){
            $errors['message']="message required";
            goto shoform;
        }else{
            $query=new comment();
            $value=$query->addmessage($name,$email,$messages);
            sendmail("Library",$email,"We've recieved your message", "Thank you for sending us a message one of our agents will get back to you soon ");
            sendmail("Library", "testlibrary05@gmail.com", "New message from ".$name, $messages);
        }
    }
     shoform:
     $show=null;
     include "./layout.phtml";
?>