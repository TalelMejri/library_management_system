<?php

    include_once "db_connected.php";
    class comment{
        private $pdo;
         public function __construct(){
            $this->pdo=new database();
         }

         public function addmessage(String $name,String $email,String $message):int{
            $sql="INSERT INTO `commentaire` (`nom`, `email`, `messages`) VALUES (:nom,:email,:messages)";
            $this->pdo->launch_query($sql,
               ['nom'=>$name,
                'email'=>$email,
                'messages'=>$message
                ]);
                return $this->pdo->lastInsertId();
        }
    }


 ?>