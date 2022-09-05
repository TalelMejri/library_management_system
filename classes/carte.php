<?php 
    class carte {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
            return $_SESSION['carte'] ? $_SESSION['carte']:[];
        }

         public function add(int $id_produit){
            if(!isset($_SESSION['carte'])){
                $_SESSION['carte']=array();
            }
            array_push($_SESSION['carte'],$id_produit);
            // baad naamel array_push($_SESSION['carte'],[$id_produit,$quantity]);
         }

         public function get(){
            // check if session carte isset and return it
            return isset($_SESSION['carte']) ? $_SESSION['carte']:[];
         }

         public function clear(){
            unset($_SESSION['carte']);
         }

        public function remove(int $id_produit){
            // remove the id_produit from the session
            if(isset($_SESSION['carte'])){
                $index=array_search($id_produit,$_SESSION['carte']);
                if($index!==false){
                    unset($_SESSION['carte'][$index]);
                }
            }
        }

        public function save(){
            $id_user=$_SESSION['userid'];
            $carte=$this->get();
            $this->pdo->launch_query("INSERT INTO comande (iduser) VALUES (?)",[$id_user]);
            $id_commande=$this->pdo->lastInsertId();
            foreach($carte as $id_produit){
                $this->pdo->launch_query("INSERT INTO line_commande (idcommande,idbook) VALUES (?,?)",[$id_commande,$id_produit]);
            }
            $this->clear();
        }


    }



?>