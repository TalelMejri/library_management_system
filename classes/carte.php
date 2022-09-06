<?php 
    class carte {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
            return isset($_SESSION['carte']) ? $_SESSION['carte']:[];
        }

        public function  add_carte(int $idbook){
            if(!isset($_SESSION['carte'])){
                $_SESSION['carte']=array();
            }
            array_push($_SESSION['carte'],$idbook);
        }

        public function get_all_commande(){
            return isset($_SESSION['carte'])? $_SESSION['carte']:[];
        }

        public function clear_carte(){
            unset($_SESSION['carte']);
        }

        public function remove(int $id_book){
            if(isset($_SESSION['carte'])){
                $index=array_search($id_book,$_SESSION['carte']);
                if($index!==false){
                    unset($_SESSION['carte'][$index]);
                }
            }
        }

        public function save(){
            $iduser=$_SESSION['userid'];
            $carte=$this->get_all_commande();
            $sql="INSERT INTO comande (iduser) VALUES (:id)";
            $this->pdo->launch_query($sql,['id'=>$iduser]);
            $id_commande=$this->pdo->lastInsertId();
            foreach($carte as $items){
                $sql="INSERT INTO line_commande (idcommande,idbook) VALUES (:idcommande,:idbook)";
                $this->pdo->launch_query($sql,['idcommande'=>$id_commande,'idbook'=>$items]);
            }
            $this->clear_carte();
        }



    }



?>