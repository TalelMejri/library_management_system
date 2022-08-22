
 <?php 
    include "db_connected.php";

    class user {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
        }

        public function login_admin(String $email,String $pass):bool{
            $sql="SELECT * FROM admin where email=:email AND password=:pass";
            $query=$this->pdo->launch_query($sql,['email'=>$email,'pass'=>$pass]);
            $user=$query->fetch();
            if($user==false){
                return false;
            }else{
                $_SESSION['id']=$user['id'];
                $_SESSION['name']=$user['name'];
                $_SESSION['email']=$user['email'];
                $_SESSION['password']=$user['password'];
                $_SESSION['role']=$user['role'];
                $_SESSION['avatar_admin']=$user['avatar_admin'];
                return true;
            }
        }

        
    }


?>