<?php 

  require_once "db_connected.php";
  class File{

     private $filename;
     private $storage_directory;
     private $file_type;
     private $tmp_directory;
     private $size_file;

      public function __construct(String $storage_personnel,array $info_file){
        $this->storage_directory=$storage_personnel;
        $this->filename=$info_file['name'];
        $this->file_type=pathinfo($this->filename,PATHINFO_EXTENSION);
        $this->tmp_directory=$info_file['tmp_name'];
        $this->size_file=$info_file['size'];
      }

      public function upload():bool{
        $this->filename=md5(rand()).' . '.$this->file_type;
        if(!move_uploaded_file($this->tmp_directory,$this->storage_directory.$this->filename)){
          return false;
        }
        return true;
      }

      public function getfilename():String{
        return $this->filename;
      }

      public function isimage():bool{
        $array_type=['jpg','png','jpeg','gif'];
        if(!in_array($this->file_type,$array_type)){
          return false;
        }
        return true;
      }

      public function size_file():bool{
        if($this->size_file>300000){
          return false;
        }
        return true;
      }
  }

?>