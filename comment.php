<?php
    include "./classes/comments_manager.php";
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
                $query->addmessage($name,$email,$messages);  
        }
    }
     shoform:
     $show=null;
     include "layout.phtml";
?>