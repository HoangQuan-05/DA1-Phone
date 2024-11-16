<?php

class Thongkes
{
    private $conn;

    public function __construct()
    {

        $this->conn = connectDB();
    }

    public function all()
    {
        $sql = " SELECT COUNT(*) FROM hoa_dons WHERE trang_thai_don_hang NOT IN (5, 6, 7)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function thong_ke_doanh_thu()
    {
        $sql = "SELECT * FROM hoa_don_chi_tiet 
        JOIN chi_tiet_san_pham ON chi_tiet_san_pham.id  = hoa_don_chi_tiet.id_chi_tiet_san_pham  ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function thong_ke_so_luong_san_pham()
    {
        $sql = "SELECT * FROM chi_tiet_san_pham ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
