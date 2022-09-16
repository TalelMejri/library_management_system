<?php 

    class chat{
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
         }

       public function  send_message(int $idenvoi,int $idrecu,String $message,String $date){
        $sql="INSERT INTO chat (idenvoi,idrecent,message,Date) VALUES (:idenvoi,:idrecu,:message,:date)";
        $this->pdo->launch_query($sql,['idenvoi'=>$idenvoi,'idrecu'=>$idrecu,'message'=>$message,'date'=>$date]);
       }

       public function getmessageofuser(int $idenvoi,int $idrecu){
        $sql="SELECT * from chat where idenvoi=:idsend and idrecent=:idrecoi or idenvoi=:idinverse and idrecent=:idreverse ";
        $query=$this->pdo->launch_query($sql,['idsend'=>$idenvoi,'idrecoi'=>$idrecu,'idinverse'=>$idrecu,'idreverse'=>$idenvoi]);
        return $query->fetchAll();
       }

    }



?>