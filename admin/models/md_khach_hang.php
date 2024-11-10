<?php
class KhachHang
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function all()
    {
        $sql = "SELECT * FROM khach_hang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM khach_hang WHERE id_khach_hang = :id_khach_hang";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id_khach_hang' => $id]);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM khach_hang WHERE id_khach_hang = :id_khach_hang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_khach_hang' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO khach_hang (tens, anh_dai_dien, email, mat_khau, so_dien_thoai, ngay_sinh, dia_chi, vai_tro) VALUES (:tens, :anh_dai_dien, :email, :mat_khau, :so_dien_thoai, :ngay_sinh, :dia_chi, :vai_tro)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
    public function update($id, $data)
    {
        $sql = "UPDATE khach_hang SET tens = :tens,anh_dai_dien = :anh_dai_dien, email = :email, so_dien_thoai = :so_dien_thoai, ngay_sinh = :ngay_sinh, dia_chi = :dia_chi WHERE id_khach_hang = $id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}