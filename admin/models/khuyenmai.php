<?php

class khuyenmais{
    public $conn=null;
    public function __construct(){
        $this->conn=connectDB();
    }
    public function all(){
        $sql="SELECT*FROM khuyen_mai 
        JOIN danh_muc ON khuyen_mai.id_danh_muc = danh_muc.id_danh_muc ORDER BY id_voucher DESC";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    public function deletel($id) {
        $sql = "DELETE FROM khuyen_mai WHERE id_voucher =$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

    }
    public function insert($data){
        $sql="INSERT INTO khuyen_mai(voucher,mo_ta,ngay_bat_dau,ngay_ket_thuc,ten_voucher,hinh_anh,id_danh_muc) VALUES (:voucher,:mo_ta,:ngay_bat_dau,:ngay_ket_thuc,:ten_voucher,:hinh_anh,:id_danh_muc)";
        $stmt= $this->conn->prepare($sql);
      
        $stmt->execute($data);
       
   
    
    }
    public function updatekm($data){
        $sql= "UPDATE khuyen_mai SET voucher=:voucher,mo_ta=:mo_ta,ngay_bat_dau=:ngay_bat_dau,ngay_ket_thuc=:ngay_ket_thuc,ten_voucher=:ten_voucher,hinh_anh=:hinh_anh,id_danh_muc=:id_danh_muc WHERE id_voucher=:id_voucher";
        $stmt= $this ->conn->prepare($sql);
        $stmt->execute($data);

    }
    public function find_one($id){
        $sql="SELECT*FROM khuyen_mai WHERE id_voucher=$id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
       }
}