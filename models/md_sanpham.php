<?php
class Md_san_pham
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function show_san_pham()
    {
        $sql = "SELECT san_phams.*, chi_tiet_san_pham.*, hinh_anhs.*
                FROM san_phams
                JOIN (
                    SELECT id_san_pham, MAX(gia_ban) AS gia_cao_nhat
                    FROM chi_tiet_san_pham
                    GROUP BY id_san_pham
                ) AS max_gia ON san_phams.id_san_pham = max_gia.id_san_pham
                JOIN chi_tiet_san_pham ON san_phams.id_san_pham = chi_tiet_san_pham.id_san_pham 
                    AND chi_tiet_san_pham.gia_ban = max_gia.gia_cao_nhat
                JOIN (
                    SELECT id_san_pham, MIN(id) AS id_cu_nhat
                    FROM hinh_anhs
                    GROUP BY id_san_pham
                ) AS hinh_anh_cu ON san_phams.id_san_pham = hinh_anh_cu.id_san_pham
                JOIN hinh_anhs ON san_phams.id_san_pham = hinh_anhs.id_san_pham
                    AND hinh_anhs.id = hinh_anh_cu.id_cu_nhat
                ORDER BY san_phams.id_san_pham DESC
                LIMIT 12 ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function show_all_san_pham($offset)
    {
        $sql = "SELECT san_phams.*, chi_tiet_san_pham.*, hinh_anhs.* 
                FROM san_phams
                JOIN (
                    SELECT id_san_pham, MAX(gia_ban) AS gia_cao_nhat
                    FROM chi_tiet_san_pham
                    GROUP BY id_san_pham
                ) AS max_gia ON san_phams.id_san_pham = max_gia.id_san_pham
                JOIN chi_tiet_san_pham ON san_phams.id_san_pham = chi_tiet_san_pham.id_san_pham 
                    AND chi_tiet_san_pham.gia_ban = max_gia.gia_cao_nhat
                JOIN (
                    SELECT id_san_pham, MIN(id) AS id_cu_nhat
                    FROM hinh_anhs
                    GROUP BY id_san_pham
                ) AS hinh_anh_cu ON san_phams.id_san_pham = hinh_anh_cu.id_san_pham
                JOIN hinh_anhs ON san_phams.id_san_pham = hinh_anhs.id_san_pham
                    AND hinh_anhs.id = hinh_anh_cu.id_cu_nhat
                ORDER BY san_phams.id_san_pham DESC LIMIT 16 OFFSET $offset  ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count_SanPham()
    {
        $sql = "SELECT COUNT(id_san_pham) FROM san_phams ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function show_san_pham_min($by, $offset)
    {
        $sql = "SELECT san_phams.*, chi_tiet_san_pham.*, hinh_anhs.* 
                FROM san_phams
                JOIN (
                    SELECT id_san_pham, MAX(gia_ban) AS gia_cao_nhat
                    FROM chi_tiet_san_pham
                    GROUP BY id_san_pham
                ) AS max_gia ON san_phams.id_san_pham = max_gia.id_san_pham
                JOIN chi_tiet_san_pham ON san_phams.id_san_pham = chi_tiet_san_pham.id_san_pham 
                    AND chi_tiet_san_pham.gia_ban = max_gia.gia_cao_nhat
                JOIN (
                    SELECT id_san_pham, MIN(id) AS id_cu_nhat  
                    FROM hinh_anhs
                    GROUP BY id_san_pham
                ) AS hinh_anh_cu ON san_phams.id_san_pham = hinh_anh_cu.id_san_pham
                JOIN hinh_anhs ON san_phams.id_san_pham = hinh_anhs.id_san_pham
                    AND hinh_anhs.id = hinh_anh_cu.id_cu_nhat
                ORDER BY gia_ban $by LIMIT 16 OFFSET $offset  ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }



    public function show_san_pham_danh_muc($by, $offset)
    {
        $sql = "SELECT san_phams.*, chi_tiet_san_pham.*, hinh_anhs.* 
                FROM san_phams
                 JOIN danh_muc ON san_phams.id_danh_muc = danh_muc.id_danh_muc 
                JOIN (
                    SELECT id_san_pham, MAX(gia_ban) AS gia_cao_nhat
                    FROM chi_tiet_san_pham
                    GROUP BY id_san_pham
                ) AS max_gia ON san_phams.id_san_pham = max_gia.id_san_pham
                JOIN chi_tiet_san_pham ON san_phams.id_san_pham = chi_tiet_san_pham.id_san_pham 
                    AND chi_tiet_san_pham.gia_ban = max_gia.gia_cao_nhat
                JOIN (
                    SELECT id_san_pham, MIN(id) AS id_cu_nhat
                    FROM hinh_anhs
                    GROUP BY id_san_pham
                ) AS hinh_anh_cu ON san_phams.id_san_pham = hinh_anh_cu.id_san_pham
                JOIN hinh_anhs ON san_phams.id_san_pham = hinh_anhs.id_san_pham
                    AND hinh_anhs.id = hinh_anh_cu.id_cu_nhat
                WHERE ten_danh_muc = '$by' LIMIT 16 OFFSET $offset  ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    public function san_pham_chi_tiet($id)
    {
        $sql = "SELECT * FROM san_phams
            JOIN danh_muc ON san_phams.id_danh_muc = danh_muc.id_danh_muc 
            WHERE id_san_pham = $id AND danh_muc.trang_thai = 'Hiển thị' ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function bien_the_san_pham($id)
    {
        $sql = "SELECT * FROM chi_tiet_san_pham
        JOIN mau_sacs ON mau_sacs.id_chi_tiet_san_pham  = chi_tiet_san_pham.id  
        JOIN phien_bans ON phien_bans.id_chi_tiet_san_pham  = chi_tiet_san_pham.id  
        WHERE id_san_pham = $id ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function hinh_anh($id)
    {
        $sql = "SELECT * FROM hinh_anhs WHERE id_san_pham  = $id ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
