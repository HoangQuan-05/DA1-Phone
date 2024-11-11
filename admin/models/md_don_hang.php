<?php

class Md_Hoa_Don
{
    public $conn = null;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function all_hoa_don()
    {
        $sql = "SELECT * ,hoa_dons.dia_chi AS dia_chi_nhan, hoa_dons.id AS id_hd  FROM hoa_dons 
        JOIN gio_hang ON gio_hang.id = hoa_dons.id_gio_hang 
        JOIN gio_hang_chi_tiet ON gio_hang_chi_tiet.id_gio_hang = gio_hang.id  
        
        JOIN trang_thai_hoa_don ON trang_thai_hoa_don.id = hoa_dons.trang_thai_don_hang 
        JOIN khach_hang ON khach_hang.id_khach_hang  = gio_hang.id_khach_hang ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find_hoa_don($id)
    {
        $sql = "SELECT * FROM hoa_don_chi_tiet 
            JOIN hoa_dons ON hoa_dons.id = hoa_don_chi_tiet.id_hoa_don 
            JOIN gio_hang ON gio_hang.id = hoa_dons.id_gio_hang 

            JOIN chi_tiet_san_pham  ON chi_tiet_san_pham.id  = hoa_don_chi_tiet.chi_tiet_san_pham 
            JOIN san_phams ON san_phams.id_san_pham  = chi_tiet_san_pham.id_san_pham

            JOIN mau_sacs ON mau_sacs.id_chi_tiet_san_pham   = chi_tiet_san_pham.id 
            JOIN phien_bans ON phien_bans.id_chi_tiet_san_pham   = chi_tiet_san_pham.id 
            WHERE id_hoa_don  =$id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //TRẠNG THÁI

    public function trang_thai_dh()
    {
        $sql = "SELECT * FROM trang_thai_hoa_don";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update_tt($id, $tt)
    {
        $sql = "UPDATE hoa_dons SET trang_thai_don_hang =$tt WHERE id = $id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
    }

    public function find_tt($id)
    {
        $sql = "SELECT *, trang_thai_hoa_don.id AS id_trang_thai FROM hoa_dons 
        JOIN trang_thai_hoa_don ON trang_thai_hoa_don.id = hoa_dons.trang_thai_don_hang 
         WHERE hoa_dons.id = $id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
