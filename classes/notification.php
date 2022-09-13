<?php 


 class notification{
       private $pdo;
       public function __construct(){
           $this->pdo=new database();
          //return isset($_SESSION['notification']) ? $_SESSION['notification']:[];
       }
        
       public function addnotifi(String $message){
        /* if(!isset($_SESSION['notification'])){
            $_SESSION['notification']=array();
         }
         array_push($_SESSION['notification'],$message);*/
         $sql="INSERT INTO notification (messages) VALUES (:message)";
         $this->pdo->launch_query($sql,['message'=>$message]);
       }

       public function get_notif(){
         $sql="SELECT * from notification";
         $query=$this->pdo->launch_query($sql);
         return $query->fetchAll();
         //return isset($_SESSION['notification']) ? $_SESSION['notification'] :[];
      }

      public function deleetbyid(int $id){
         $sql="DELETE from notification where id=:id";
         $this->pdo->launch_query($sql,['id'=>$id]);
      }

       public function lenght_notif(){
          $sql="SELECT count(id) from notification";
          $query=$this->pdo->query($sql);
          $value=$query->fetch();
          return $value['count(id)'];
         //return isset($_SESSION['notification']) ? count($_SESSION['notification']) : 0;
       }

     

      /* public function clear_notif(){
          unset($_SESSION['notification']);
       }*/
  
 }

?>