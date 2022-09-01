
 <?php 
    require_once "db_connected.php";

    class book{
        private $pdo;
         public function __construct(){
            $this->pdo=new database();
         }

         public function add_book(String $name,String $author,String $desc,int $nbr,String $date,String $avatar,int $status =0){
            $sql="INSERT INTO `book`(`name_book`, `author_book`, `description_book`, `nbr_book`, `status`, `avatar`,`date_book`) VALUES (:nameofbook,:author,:descr,:nbr,:statu,:avatar,:date)";
            $this->pdo->launch_query($sql,[
                 'nameofbook'=>$name,
                 'author'=>$author,
                 'descr'=>$desc,
                 'nbr'=>$nbr,
                 'statu'=>'enable',
                 'avatar'=>$avatar,
                 'date'=>$date
         ]);
          return $this->pdo->lastInsertId();
         }

         public function get_all(){
            $sql="SELECT * FROM book ";
            $query= $this->pdo->launch_query($sql);
            return $query->fetchAll();
         }

         public function getbookbyid(int $id){
            $sql="SELECT * from book where idbook=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            return $query->fetch();
         }

         public function count_books():String{
            $sql="SELECT count(*) FROM book";
            $query=$this->pdo->launch_query($sql);
            $value=$query->fetch();
            return $value['count(*)'];
         }

         public function nombre_books_enabel_or_not(String $stat){
            $sql="SELECT count(*) from book where status=:statu";
            $query=$this->pdo->launch_query($sql,['statu'=>$stat]);
            $value=$query->fetch();
            return $value['count(*)'];
         }

         public function delete_book(int $id):void{
            $sql="DELETE from book where idbook=:id";
            $this->pdo->launch_query($sql,['id'=>$id]);
         }

         public function getbookbyname(String $name){
            $sql="SELECT * from book where 'name_book'=:name";
            $query=$this->pdo->launch_query($sql,['name'=>$name]);
            return $query->fetch();
         }

         public function deleteallbook(){
            $sql="DELETE from book";
            $this->pdo->launch_query($sql);
        }
        public function updatebook(int $id,String $nom,String $author,String $desc,int $nbr,string $avatar,bool $avatarupload){
         if($avatarupload){ 
           $sql="UPDATE book SET `name_book`=:nom,`author_book`=:author,`description_book`=:desc,`nbr_book`=:nbr,`avatar`=:avatar WHERE idbook=:id";
            $this->pdo->launch_query($sql,[
               'nom'=>$nom,
               'author'=>$author,
               'desc'=>$desc,
               'nbr'=>$nbr,
               'avatar'=>$avatar,
               'id'=> $id
            ]);
         }else{
            $sql="UPDATE book SET `name_book`=:nom,`author_book`=:author,`description_book`=:desc,`nbr_book`=:nbr WHERE idbook=:id";
            $this->pdo->launch_query($sql,[
               'nom'=>$nom,
               'author'=>$author,
               'desc'=>$desc,
               'nbr'=>$nbr,
               'id'=> $id
            ]);
         }
         }

         public function gettopratebook(){
            $sql="SELECT * from book  order by rate DESC limit 3";
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
         }

         public function getnewbok(){
            $sql="SELECT * from book  order by date_book DESC limit 3";
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
         }
    }

?>,