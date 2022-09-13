<?php 


 class notification{

       public function __cunstruct(){
         return isset($_SESSION['notification']) ? $_SESSION['notification'] :[];
       }

       public function addnotifi(String $message){
         if(!isset($_SESSION['notification'])){
            $_SESSION['notification']=array();
         }
         array_push($_SESSION['notification'],$message);
       }

       public function lenght_notif(){
         return isset($_SESSION['notification']) ? count($_SESSION['notification']) : 0;
       }

       public function get_notif(){
        return isset($_SESSION['notification']) ? $_SESSION['notification'] :[];
       }

       public function clear_notif(){
        unset($_SESSION['notification']);
       }

       
 }


?>