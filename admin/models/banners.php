<?php

class banners{
    public $conn=null;
    public function __construct(){
        $this->conn=connectDB();
    }
    public function all(){
        $sql="SELECT*FROM banner ORDER BY id_banner DESC";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function delete($id) {
        $sql = "DELETE FROM banner WHERE id_banner =$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

    }
    public function insert($data){
        $sql="INSERT INTO banner(hinh_anhs,mo_ta) VALUES (:hinh_anhs,:mo_ta)";
        $stmt= $this->conn->prepare($sql);
      
        $stmt->execute($data);
   
    
    }
    public function update($data){
        $sql= "UPDATE banner SET hinh_anhs=:hinh_anhs,mo_ta=:mo_ta WHERE id_banner=:id_banner";
        $stmt= $this ->conn->prepare($sql);
        $stmt->execute($data);
    }
    public function find_one($id){
        $sql="SELECT*FROM banner WHERE id_banner=$id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
       }



}