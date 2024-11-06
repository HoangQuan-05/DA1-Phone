<?php

class tin_tuc
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function list_news()
    {
        $sql = "SELECT * FROM tin_tuc ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete_news($id_tin_tuc)
    {
        $sql = "DELETE FROM tin_tuc WHERE id_tin_tuc = :id_tin_tuc";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_tin_tuc' => $id_tin_tuc]);
    }

    public function create_news($data)
    {
        $sql = "INSERT INTO tin_tuc (tieu_des,noi_dungs,trang_thai) VALUES (:tieu_des, :noi_dungs,:trang_thai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function find_one($id)
    {
        $sql = " SELECT * FROM tin_tuc WHERE id_tin_tuc = $id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update_tin_tuc($id,$data){
        $sql ="UPDATE tin_tuc SET tieu_des = :tieu_des, noi_dungs =:noi_dungs, trang_thai =:trang_thai WHERE id_tin_tuc = $id";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }
}