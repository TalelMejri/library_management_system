
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

        public function  edit_admin(String $name,String $email,String $password,String $avatar){
            $sql="UPDATE `admin` SET id=:id_admin,name=:name_admin,email=:email_admin,password=:pass,avatar_admin=:avatar";
            $this->pdo->launch_query($sql,[
                'id_admin'=>$id,
                'name_admin'=>$name,
                'email_admin'=>$email,
                'pass'=>$password,
                'avatar'=>$avatar]);
        }

        public function signup(String $name,String $email,int $cin,int $tlf,String $password,String $avatar){
            $sql="INSERT INTO `admin`(`id`, `name`, `email`, `password`, `avatar_admin`, `tlf`, `cin`, `role`, `corbeille`)  VALUES (:name,:email,:pass,:avatar,:tlf,:cin,:role,:corbeille)";
            $this->pdo->launch_query($sql,[
                'name'=>$name,
                'email'=>$email,
                'pass'=>$password,
                'avatar'=>$avatar,
                'role'=>0,
                'cin'=>$cin,
                'tlf'=>$tlf,
                'corbeille'=>0,
            ]);
            return $this->pdo->lastInsertId();
        }

        
    }


?>