<?php 
    class carte {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
            return isset($_SESSION['carte']) ? $_SESSION['carte']:[];
        }

        public function  add_carte(int $idbook,int $quantity){
            if(!isset($_SESSION['carte'])){
                $_SESSION['carte']=array();
            }
            array_push($_SESSION['carte'],[$idbook,$quantity]);
        }

        public function length_tab(){
            return isset($_SESSION['carte']) ? count($_SESSION['carte']) : 0;
        }

        public function get_all_commande(){
            return isset($_SESSION['carte'])? $_SESSION['carte']:[];
        }

        public function clear_carte(){
            unset($_SESSION['carte']);
        }


    public function remove(int $id_book){
       if(isset($_SESSION['carte'])){
        $index=-1; 
        for($i=0;$i<=$this->length_tab();$i++){
            if(isset($_SESSION['carte'][$i])){
                if($_SESSION['carte'][$i][0]==$id_book){
                    $index=$i;
                }
             }
         }
         if($index!=-1){
            unset($_SESSION['carte'][$index]);
         }
            }
        }

        public function save(int $choix=0){
            $iduser=$_SESSION['userid'];
            $carte=$this->get_all_commande();
            $sql="INSERT INTO comande (iduser,aveclivraison) VALUES (:id,:liv)";
            $this->pdo->launch_query($sql,['id'=>$iduser,'liv'=>$choix]);
            $id_commande=$this->pdo->lastInsertId();
            foreach($carte as $items){
                $sql="INSERT INTO line_commande (idcommande,idbook,quantity) VALUES (:idcommande,:idbook,:quantity)";
                $this->pdo->launch_query($sql,['idcommande'=>$id_commande,'idbook'=>$items[0],'quantity'=>$items[1]]);
            }
            $this->clear_carte();
        }
        
        public function getallreviews(int $idbook){
            $sql="SELECT * from rate r,admin a where r.iduser=a.id and r.idbook=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$idbook]);
            return $query->fetchAll();
           }
           
           public function verfier_rate_user(int $id,int $idbook){
            $sql="SELECT * from rate where idbook=:idbook and iduser=:id and addrate=1";
            $query=$this->pdo->launch_query($sql,['idbook'=>$idbook,'id'=>$id]);
            return $query->fetch();
           }

           public function sommerate(int $id){
                $sql="SELECT AVG(rate) from rate where idbook=:id";
                $query=$this->pdo->launch_query($sql,['id'=>$id]);
                $value=$query->fetch();
                return $value['AVG(rate)'];
           }


    }



?>