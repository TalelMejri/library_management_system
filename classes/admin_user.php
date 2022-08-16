
 <?php 
    include "./db_connected.php";
    class admin {

        private $pdo;
        public function __constuct(){
            $this->pdo=new database();
        }

        public function login_admin(String $email,String $pass){
            
        }
    }


?>