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
        $sql = "SELECT * FROM khach_hang ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function find($id) {
        $sql = "SELECT * FROM khach_hang WHERE id_khach_hang = :id_khach_hang";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_khach_hang' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
