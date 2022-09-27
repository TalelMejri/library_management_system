
 <?php 
    class user {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
        }

        /**
         * login admin
         * @param String $email
         * @param String $pass
         */
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
        /**
         * login user
         * @param String $email
         * @param String $password
         */
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
            else if ($user["corbeille"]==1){
                return 3;
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
 /**
         * edit admin
         * @param String $name
         * @param String $email
         * @param String $password
         * @param String $avatar
         * @param int $id
         * @param int $avatarupload
         */
        public function  edit_admin(String $name,String $email,String $password,String $avatar,int $id,int $avatarupload){
        if($avatarupload){
            $sql="UPDATE `admin` SET name=:name_admin,email=:email_admin,password=:pass,avatar_admin=:avatar where id=:id_admin";
            $this->pdo->launch_query($sql,[
                'id_admin'=>$id,
                'name_admin'=>$name,
                'email_admin'=>$email,
                'pass'=>password_hash($password,PASSWORD_DEFAULT),
                'avatar'=>$avatar
            ]);
          }else{
                    $sql="UPDATE `admin` SET name=:name_admin,email=:email_admin,password=:pass where id=:id_admin";
                    $this->pdo->launch_query($sql,[
                        'id_admin'=>$id,
                        'name_admin'=>$name,
                        'email_admin'=>$email,
                        'pass'=>password_hash($password,PASSWORD_DEFAULT),
                       
                    ]);
        }
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

        public function edituser(String $name,String $email,String $pass,String $tlf,String $cin,String $avatar,int $id,int $avatarupload){
            
            if($avatarupload){
                $sql="UPDATE `admin` SET name=:name,email=:email,password=:pass,avatar_admin=:avatar,tlf=:tlf,cin=:cin where id=:iduser";
                $this->pdo->launch_query($sql,[
                 'iduser'=>$id,
                 'cin'=>$cin,
                 'tlf'=>$tlf,
                 'name'=>$name,
                 'email'=>$email,
                 'pass'=>$pass,
                 'avatar'=>$avatar
             ]);
         }else{
            $sql="UPDATE `admin` SET name=:name,email=:email,password=:pass,tlf=:tlf,cin=:cin where id=:iduser";
            $this->pdo->launch_query($sql,[
             'iduser'=>$id,
             'cin'=>$cin,
             'tlf'=>$tlf,
             'name'=>$name,
             'email'=>$email,
             'pass'=>$pass
            
           ]);
            }
            $sql="SELECT * FROM admin where id=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            $user=$query->fetch();
            $_SESSION['userid']=$user['id'];
            $_SESSION['username']=$user['name'];
            $_SESSION['useremail']=$user['email'];
            $_SESSION['userpassword']=$user['password'];
            $_SESSION['userrole']=$user['role'];
            $_SESSION['usertlf']=$user['tlf'];
            $_SESSION['usercin']=$user['cin'];
            $_SESSION['useravatar']=$user['avatar_admin'];

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

        public function getalluser(int $limit,int $start){
            $sql="SELECT * from admin where role=:rolee   limit $start,$limit";
            $query=$this->pdo->launch_query($sql,['rolee'=>0]);
            return $query->fetchAll();
        }

        public function getbyname(STRING $name,int $limit,int $start){
            $name_search="%".$name."%";
            $sql="SELECT * FROM admin where role=:rolee AND name like :name limit $start,$limit";
            $query=$this->pdo->launch_query($sql,['rolee'=>0,'name'=>$name_search]);
            return $query->fetchAll();
        }

        public function countusersearch(string $name){
            $name_search="%".$name."%";
            $sql="SELECT count(*) FROM admin where role=:rolee AND name like :name";
            $query=$this->pdo->launch_query($sql,['rolee'=>0,'name'=>$name_search]);
            $value=$query->fetch();
            return $value['count(*)'];
        }

        public function countuser(){
            $sql="SELECT count(*) from admin where role=:rolee ";
            $query=$this->pdo->launch_query($sql,['rolee'=>0]);
            $value=$query->fetch();
            return $value['count(*)'];
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

        public function checkToken(String $email, String $token){
            $sql="SELECT * from admin where password_token=:tok and email=:email";
            $query=$this->pdo->launch_query($sql,['tok'=>$token,'email'=>$email]);
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

        public function addtokenEmail(String $token,int $id){
            $sql="UPDATE  admin SET  token=:token where id=:id ";
            $this->pdo->launch_query($sql,['token'=>$token,'id'=>$id]);
        } 
        
        public function changerpassword(int $id,String $password){
            $sql="UPDATE admin SET password=:pass where id=:id";
            $this->pdo->launch_query($sql,['pass'=>password_hash($password,PASSWORD_DEFAULT),'id'=>$id]);
        }


        public function AddLikedBook(int $id,int $idbook){
            $sql="SELECT * from user_liked where id_user=:id AND id_book=:idbook";
            $query= $this->pdo->launch_query($sql,['id'=>$id,'idbook'=>$idbook]);
            $user=$query->fetch();
            if(!$user){
                $sql="INSERT INTO user_liked (id_book,id_user,liked) VALUES (:idbook,:iduser,:liked)";
                $this->pdo->launch_query($sql,['idbook'=>$idbook,'iduser'=>$id,'liked'=>true]);
            }else{
                $sql="UPDATE user_liked SET liked=:liked_new where id_book=:idbook AND id_user=:id";
                $this->pdo->launch_query($sql,['liked_new'=>!$user['liked'],'idbook'=>$idbook,'id'=>$id]);
            }
        }

        public function AddfavoriteBook(int $id,int $idbook){
            $sql="SELECT * from books_favorite where iduser=:id AND idbook=:idbook";
            $query= $this->pdo->launch_query($sql,['id'=>$id,'idbook'=>$idbook]);
            $user=$query->fetch();
            if(!$user){
                $sql="INSERT INTO books_favorite (idbook,iduser,favorite) VALUES (:idbook,:iduser,:favorite)";
                $this->pdo->launch_query($sql,['idbook'=>$idbook,'iduser'=>$id,'favorite'=>true]);
            }else{
                $sql="UPDATE books_favorite SET favorite=:favorite_new where idbook=:idbook AND iduser=:id";
                $this->pdo->launch_query($sql,['favorite_new'=>!$user['favorite'],'idbook'=>$idbook,'id'=>$id]);
            }
        }

        public function getalluser_liked(int $id,int $idbook){
            $sql="SELECT liked from user_liked where id_user=:id AND id_book=:idbook";
            $query= $this->pdo->launch_query($sql,['id'=>$id,'idbook'=>$idbook]);
            return $query->fetch();
        }

        public function getalluser_favorite(int $id,int $idbook){
            $sql="SELECT favorite from books_favorite where iduser=:id AND idbook=:idbook";
            $query= $this->pdo->launch_query($sql,['id'=>$id,'idbook'=>$idbook]);
            return $query->fetch();
        }
        
        public function sommeliked(int $id){
            $sql="SELECT sum(liked) from user_liked where id_book=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            $value=$query->fetch();
            return $value['sum(liked)'];
        }
        
        public function chercher_user_commande(int $id){
            $sql="SELECT * from comande where iduser=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            return $query->fetchAll();
        }

        public function get_user_chat(int $id){
            $sql="SELECT * from admin where id!=:id and  corbeille=:corb";
            $query=$this->pdo->launch_query($sql,['id'=>$id,'corb'=>0]);
            return $query->fetchAll();
        }

        public function Count_User(){
            $sql="SELECT count(id) from admin where role=:role";
            $query=$this->pdo->launch_query($sql,['role'=>0]);
            $value= $query->fetch();
            return $value['count(id)'];
        }

     

  
    }


?>