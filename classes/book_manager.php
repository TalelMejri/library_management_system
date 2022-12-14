
 <?php 
    class book{
        private $pdo;
         public function __construct(){
            $this->pdo=new database();
         }

         public function add_book(String $name,String $author,String $desc,int $nbr,String $date,String $avatar,String $genre,int $prix){
            $sql="INSERT INTO `book`(`name_book`, `author_book`, `description_book`, `nbr_book`, `status`, `avatar`,`genre`,`date_book`,`Prix`) VALUES (:nameofbook,:author,:descr,:nbr,:statu,:avatar,:genre,:date,:prix)";
            $this->pdo->launch_query($sql,[
                 'nameofbook'=>$name,
                 'author'=>$author,
                 'descr'=>$desc,
                 'nbr'=>$nbr,
                 'statu'=>'enable',
                 'avatar'=>$avatar,
                 'date'=>$date,
                 'genre'=>$genre,
                 'prix'=>$prix
         ]);
          return $this->pdo->lastInsertId();
         }
         
         public function get_all_book(){
            $sql="SELECT * FROM book";
            $query= $this->pdo->launch_query($sql);
            return $query->fetchAll();
         }

         public function get_all(int $limit,int $start,String $choix){
            if(empty($choix)){
               $sql="SELECT * FROM book  limit $start,$limit ";
               $query= $this->pdo->launch_query($sql);
               return $query->fetchAll();
            }else{
               $sql="SELECT * FROM book  order by $choix limit $start,$limit ";
               $query= $this->pdo->launch_query($sql);
               return $query->fetchAll();
            }
           
         }

         public function getbookbyid(int $id){
            $sql="SELECT * from book where idbook=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            return $query->fetch();
         }
          public function count_book(){
            $sql="SELECT count(*) FROM book";
            $query=$this->pdo->launch_query($sql);
            $value=$query->fetch();
            return $value['count(*)'];
          }

         public function nombre_books_enable(){
            $sql="SELECT Sum(nbr_book) from book";
            $query=$this->pdo->launch_query($sql);
            $value=$query->fetch();
            return $value['Sum(nbr_book)'];
         }

         public function nombre_books_not_enable(){
             $sql="SELECT Sum(quantity) from line_commande";
             $query=$this->pdo->launch_query($sql);
             $value=$query->fetch();
             return $value['Sum(quantity)'];
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

       

         public function getBookfavoris(int $id){
            $sql="SELECT b.genre from book b ,books_favorite bf,admin a where b.idbook=bf.idbook and bf.iduser=id and a.id=$id and bf.favorite=1";
            $query=$this->pdo->launch_query($sql);
            $value=$query->fetchAll();
            if(empty($value)){
               $sql="SELECT b.genre from book b ,user_liked ul,admin a where b.idbook=ul.id_book and ul.id_user=id and a.id=$id and ul.liked=1";
               $query=$this->pdo->launch_query($sql);
               $value=$query->fetchAll();
            }
           $tout_book=array();
           for($i=0;$i<count($value);$i++){ 
             $sql="SELECT * from book where genre=:genre";
             $query=$this->pdo->launch_query($sql,['genre'=>$value[$i]['genre']]);
             $final_result=$query->fetchAll();
             array_push($tout_book,$final_result);
           }
            return $final_result;
         }

         public function getbooksfavorite(int $iduser){
            $sql="SELECT * from book b,books_favorite f where b.idbook=f.idbook and f.iduser=:id and f.favorite=:favorite";
            $query=$this->pdo->launch_query($sql,['id'=>$iduser,'favorite'=>1]);
            return $query->fetchAll();
         }
         
         public function getbookbygenre(string $genre){
            $sql="SELECT * from book where genre=:genre";
            $query=$this->pdo->launch_query($sql,['genre'=>$genre]);
            return $query->fetchAll();
         }
       
         public function orderBy(String $choix){
            $sql="SELECT * FROM book order by $choix DESC";
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
         }
     
          public function getnamebookById(int $id){
            $sql="SELECT name_book from book where idbook=$id";
            $query=$this->pdo->launch_query($sql);
            $value=$query->fetch();
            return $value['name_book'];
          }
         public function searchforbook(string $name_book){
            $name="%".$name_book."%";
            $sql="SELECT * from book where name_book like :name";
            $query=$this->pdo->launch_query($sql,['name'=>$name]);
            return $query->fetchAll();
         }

         public function getcommande_user(int $id){
             $sql="SELECT * from comande c where c.iduser=:id";
             $query=$this->pdo->launch_query($sql,['id'=>$id]);
             return $query->fetchAll();
         }

      /*  public function allcommandeinadmin(){
            $sql="SELECT * from book b,comande c,line_commande l,admin a where b.idbook=l.idbook and c.idcommande=l.idcommande and c.iduser=a.id";
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
        }*/
        public function allcommandeinadmin(){
         $sql="SELECT * from comande c";
         $query=$this->pdo->launch_query($sql);
         return $query->fetchAll();
     }
     public function all_line_commande_by_id(int $id){
      $sql="SELECT * from book b,comande c,line_commande l,admin a where b.idbook=l.idbook and c.idcommande=l.idcommande and c.iduser=a.id and l.idcommande=$id";
      $query=$this->pdo->launch_query($sql);
      return $query->fetchAll();
  }
/*public function verifiercommande(){
   $sql="SELECT * from book b,comande c,line_commande l,admin a  where b.idbook=l.idbook and c.idcommande=l.idcommande and c.iduser=a.id and c.valider=1";
   $query=$this->pdo->launch_query($sql);
   return $query->fetchAll();
}*/
        
        public function getcommnadebyid(int $id){
         $sql="SELECT * from book b,comande c,line_commande l  where b.idbook=l.idbook and c.idcommande=l.idcommande and c.idcommande=$id";
         $query=$this->pdo->launch_query($sql);
         return $query->fetchAll();
     }
        
        public function check_info_user(int $idcommande){
         $sql="SELECT * from admin a,comande c where a.id=c.iduser and idcommande=$idcommande";
         $query=$this->pdo->launch_query($sql);
         return $query->fetch();
     }


        public  function updatevalider(int $idcommande,int $idbook,int $quantity)
        {
         $sql="UPDATE comande SET valider=1 where idcommande=:id";
         $this->pdo->launch_query($sql,['id'=>$idcommande]);

         $sql="SELECT * from book where idbook=:idbook";
         $query=$this->pdo->launch_query($sql,['idbook'=>$idbook]);
         $value=$query->fetch();
         if($value['nbr_book']>0){
             $sql="UPDATE book SET nbr_book=:nbr where idbook=:idbook";
             $this->pdo->launch_query($sql,['nbr'=>$value['nbr_book']-$quantity,'idbook'=>$idbook]);
         }
        }

        public function deletecommande(int $id){
           $sql="DELETE from comande where idcommande=:id";
           $this->pdo->launch_query($sql,['id'=>$id]);
        }

        public function addrate(int $iduser,int $idbook,int $rate){
          $sql="INSERT INTO rate (iduser,idbook,rate,addrate) VALUES (:iduser,:idbook,:nbr,:addrate)";
          $this->pdo->launch_query($sql,['iduser'=>$iduser,'idbook'=>$idbook,'nbr'=>$rate,'addrate'=>1]);
        }

        public function gettopratebook(){
       //$sql="SELECT * from rate r,book b where r.idbook=b.idbook order by avg(r.rate)";
         $sql="SELECT * from rate r,book b where r.idbook=b.idbook order by r.rate limit 3";
         $query=$this->pdo->launch_query($sql);
         return $query->fetchAll();
      }

      /*   public function decrease_nbr_book(int $id,int $iduser){
            $sql="SELECT * from book where idbook=:id";
            $query=$this->pdo->launch_query($sql,['id'=>$id]);
            $book_add= $query->fetch();
            $quatity=0;
            //$nbr=(int)$book_add['nbr_book'];
            if($book_add['nbr_book']>0){
               $quatity=+1;
               $sql="UPDATE book SET nbr_book=:nbr where idbook=:id";
               $this->pdo->launch_query($sql,['nbr'=>$book_add['nbr_book']-1,'id'=>$id]);
               $sql="INSERT INTO `comande`( `iduser`, `aveclivraison`, `valider`) VALUES (:iduser,:livraison,:valider)";
               $this->pdo->launch_query($sql,['iduser'=>$iduser,'livraison'=>null,'valider'=>0]);
               $_SESSION['idbook']=$id;
               $_SESSION['idcommande']=$this->pdo->lastInsertId();
               $_SESSION['quantity']=$quatity;
            }
         }*/
         
    }

?>,