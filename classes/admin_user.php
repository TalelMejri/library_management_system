
 <?php 
    include "db_connected.php";

    class user {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
        }

        public function login_admin(String $email,String $pass):bool{
            $sql="SELECT * FROM admin where email=:email AND role=:role";
            $query=$this->pdo->launch_query($sql,[
                'email'=>$email,
                'role'=>1
            ]);
                $admin=$query->fetch();
            if($admin==false){
                return false;
            }else if (!password_verify($pass,$admin["password"])){
                return false;
            }
            else{
                $_SESSION['id']=$admin['id'];
                $_SESSION['name']=$admin['name'];
                $_SESSION['email']=$admin['email'];
                $_SESSION['password']=$admin['password'];
                $_SESSION['role']=$admin['role'];
                $_SESSION['avatar_admin']=$admin['avatar_admin'];
                return true;
            }
        }

        public function login_user(String $email,String $password){
            $sql="SELECT * FROM `admin` where  role=:role AND email=:email";
            $query=$this->pdo->launch_query($sql,[
                'email'=>$email,
                'role'=>0
            ]);
            $user=$query->fetch();
            if($user==false){
                return 0;
            }
            else if (!password_verify($password,$user["password"])){
                return 0;
            }
            else if ($user["verified"]==0){
                return 2;
            }
            else{
                $_SESSION['userid']=$user['id'];
                $_SESSION['username']=$user['name'];
                $_SESSION['useremail']=$user['email'];
                $_SESSION['userpassword']=$user['password'];
                $_SESSION['userrole']=$user['role'];
                $_SESSION['usertlf']=$user['tlf'];
                $_SESSION['usercin']=$user['cin'];
                $_SESSION['useravatar']=$user['avatar_admin'];
                return 1;
            }
        }

        public function  edit_admin(String $name,String $email,String $password,String $avatar,int $id){
            $sql="UPDATE `admin` SET name=:name_admin,email=:email_admin,password=:pass,avatar_admin=:avatar where id=:id_admin";
            $this->pdo->launch_query($sql,[
                'id_admin'=>$id,
                'name_admin'=>$name,
                'email_admin'=>$email,
                'pass'=>$password,
                'avatar'=>$avatar
            ]);
            $sql="SELECT * FROM admin where id=:id";
            $query=$this->pdo->launch_query($sql,[
                'id'=>$id,
            ]);
            $admin=$query->fetch();
            $_SESSION['id']=$admin['id'];
            $_SESSION['name']=$admin['name'];
            $_SESSION['email']=$admin['email'];
            $_SESSION['password']=$admin['password'];
            $_SESSION['role']=$admin['role'];
            $_SESSION['avatar_admin']=$admin['avatar_admin'];
        }

        public function signup(String $name,String $email,int $cin,int $tlf,String $password,String $avatar,string $token){
            $sql="INSERT INTO `admin`( `name`, `email`, `password`, `avatar_admin`, `tlf`, `cin`, `role`, `corbeille`, `status`, `token`)  VALUES (:name,:email,:pass,:avatar,:tlf,:cin,:role,:corbeille,:statu,:token)";
            $this->pdo->launch_query($sql,[
                'name'=>$name,
                'email'=>$email,
                'pass'=>password_hash($password,PASSWORD_DEFAULT),
                'avatar'=>$avatar,
                'role'=>0,
                'cin'=>$cin,
                'tlf'=>$tlf,
                'corbeille'=>0,
                'statu'=>0,
                'token'=>$token
            ]);
            return $this->pdo->lastInsertId();
        }

        public function allcin(){
            $sql="SELECT cin from admin";
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
        }

        public function getalluser(){
            $sql="SELECT * from admin where role=:rolee AND corbeille=:corb";
            $query=$this->pdo->launch_query($sql,['rolee'=>0,'corb'=>0]);
            return $query->fetchAll();
        }

        public function getalluserdeleted(){
            $sql="SELECT * from admin where role=:rolee AND corbeille=:corb";
            $query=$this->pdo->launch_query($sql,['rolee'=>0,'corb'=>1]);
            return $query->fetchAll();
        }

        public function deleteuser(int $id){
            $sql="UPDATE admin SET corbeille=:corb where id=:iduser";
            $this->pdo->launch_query($sql,['corb'=>1,'iduser'=>$id]);
        }

        public function deleteuserforever(int $id){
            $sql="DELETE from admin where id=:iduser";
            $this->pdo->launch_query($sql,['iduser'=>$id]);
        }

        public function backuser(int $id){
            $sql="UPDATE admin SET corbeille=:corb where id=:iduser";
            $this->pdo->launch_query($sql,['corb'=>0,'iduser'=>$id]);
        }
        

        public function getuserbyid(int $id){
            $sql="SELECT * from admin where id=:iduser";
            $query=$this->pdo->launch_query($sql,['iduser'=>$id]);
            return $query->fetch();
        }

        public function checkEmail(String $email){
            $sql="SELECT * from admin where email=:email";
            $query=$this->pdo->launch_query($sql,['email'=>$email]);
             $verifier= $query->fetch();
            if($verifier==true){
                return $verifier;
            }else{
                return false;
            }
        }

        public function checkToken(String $token){
            $sql="SELECT * from admin where password_token=:tok";
            $query=$this->pdo->launch_query($sql,['tok'=>$token]);
             $verifier= $query->fetch();
            if($verifier==true){
                return $verifier;
            }else{
                return false;
            }
        }

        public function checkCin(String $cin){
            $sql="SELECT * from admin where cin=:cin";
            $query=$this->pdo->launch_query($sql,['cin'=>$cin]);
             $verifier= $query->fetch();
            if($verifier==true){
                return true;
            }else{
                return false;
            }
        }

        public function validateEmail(String $email,String $token):int{
            $sql="SELECT * from admin where email=:email";
            $query=$this->pdo->launch_query($sql,['email'=>$email]);
            $user=$query->fetch();
             try{
                if($user){
                    if($user['verified']==1){
                        // user is already verified
                        return 2;
                    }else{
                        if($user['token']!=$token){
                            // Token doesn't match email adress
                            return 4;
                        }
                        $sql = "UPDATE admin SET `verified`=1, token=null WHERE id = :id";
                        $this->pdo->launch_query($sql,['id'=>$user['id']]);
                        // Good to go
                        return 1;
                    }
                }else{
                    // first error  :: user doesn't exist 
                    return 0;
                }
            }
            catch(Exception $e)
            {
                // Something went wrong
                return 3;
            }
        }

        public function addtoken(int $token,int $id){
            $sql="UPDATE  admin SET  password_token=:token where id=:id ";
            $this->pdo->launch_query($sql,['token'=>$token,'id'=>$id]);
        } 
        
        public function changerpassword(String $token,String $password){
            $sql="UPDATE admin SET password=:pass where password_token=:token";
            $this->pdo->launch_query($sql,['pass'=>password_hash($password,PASSWORD_DEFAULT),'token'=>$token]);
        }
  
    }


?>