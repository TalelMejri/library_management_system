
 <?php 
    require_once "db_connected.php";

    class book{
        private $pdo;
         public function __construct(){
            $this->pdo=new database();
         }

         public function add_book(String $name,String $author,String $desc,int $nbr,String $avatar,int $status =0){
            $sql="INSERT INTO `book`(`name_book`, `author_book`, `description_book`, `nbr_book`, `status`, `avatar`) VALUES (:nameofbook,:author,:descr,:nbr,:statu,:avatar)";
            $this->pdo->launch_query($sql,[
                 'nameofbook'=>$name,
                 'author'=>$author,
                 'descr'=>$desc,
                 'nbr'=>$nbr,
                 'statu'=>'enable',
                 'avatar'=>$avatar
         ]);
          return $this->pdo->lastInsertId();
         }

         public function get_all(){
            $sql="SELECT * FROM book ";
            $query= $this->pdo->launch_query($sql);
            return $query->fetchAll();
         }
    }

?>