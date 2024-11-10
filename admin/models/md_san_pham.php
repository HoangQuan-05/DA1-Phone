<?php

class Md_san_pham
{
    public $conn = null;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function show()
    {
        $sql = "SELECT * FROM san_phams
            JOIN danh_muc ON san_phams.id_danh_muc = danh_muc.id_danh_muc 
            JOIN chi_tiet_san_pham ON san_phams.id_san_pham = chi_tiet_san_pham.id_san_pham";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_anh()
    {
        $sql = "SELECT * FROM hinh_anhs
            JOIN san_phams ON san_phams.id_san_pham  = hinh_anhs.id_san_pham  ";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function show_anh_san_pham($id)
    {
        $sql = "SELECT * FROM hinh_anhs
            WHERE id_san_pham = $id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function creat_san_pham($data)
    {
        $sql = "INSERT INTO san_phams (ten_san_pham, mo_ta_ngan, mo_ta_dai, id_danh_muc, luot_xem) 
                VALUES(:ten_san_pham, :mo_ta_ngan, :mo_ta_dai, :id_danh_muc, :luot_xem)";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }
    public function find_one($id)
    {
        $sql = "SELECT * FROM san_phams
        JOIN danh_muc ON san_phams.id_danh_muc = danh_muc.id_danh_muc 
        WHERE id_san_pham = $id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function creat_hinh_anh($data)
    {
        $sql = "INSERT INTO hinh_anhs (id_san_pham, hinh_anh) 
        VALUES(:id_san_pham, :hinh_anh)";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }
    public function update_hinh_anh($data)
    {
        $sql = "UPDATE hinh_anhs SET  hinh_anh = :hinh_anh WHERE id  = :id ";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }
    public function creat_chi_tiet_san_pham($data)
    {
        $sql = "INSERT INTO chi_tiet_san_pham (gia_ban, so_luong, id_san_pham) 
                VALUES(:gia_ban, :so_luong, :id_san_pham)";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }

    public function creat_mau_sac($data)
    {
        $sql = "INSERT INTO mau_sacs (id_chi_tiet_san_pham , mau_sac) 
                VALUES(:id_chi_tiet_san_pham , :mau_sac)";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }

    public function creat_phien_ban($data)
    {
        $sql = "INSERT INTO phien_bans (id_chi_tiet_san_pham , phien_ban) 
                VALUES(:id_chi_tiet_san_pham , :phien_ban)";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }

    public function update_sanpham($id, $data)
    {
        $sql = "UPDATE san_phams SET ten_san_pham = :ten_san_pham, id_danh_muc= :id_danh_muc, mo_ta_ngan= :mo_ta_ngan, mo_ta_dai = :mo_ta_dai WHERE id_san_pham = $id";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }
    public function update_san_pham_chi_tiet($id, $data)
    {
        $sql = "UPDATE chi_tiet_san_pham SET so_luong = :so_luong, gia_ban= :gia_ban WHERE  id = $id";
        $result = $this->conn->prepare($sql);
        $result->execute($data);
    }

    public function find_one_time()
    {
        $sql = "SELECT * FROM san_phams
        ORDER BY id_san_pham  DESC";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function find_one_time_chi_tiet()
    {
        $sql = "SELECT * FROM chi_tiet_san_pham
        ORDER BY id  DESC";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function find_one_sp_chi_tiet($id)
    {
        $sql = "SELECT * FROM chi_tiet_san_pham
        WHERE id_san_pham  = $id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    public function find_one_phien_ban($id)
    {
        $sql = "SELECT * FROM phien_bans
        WHERE id_chi_tiet_san_pham   = $id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find_one_mau_sac($id)
    {
        $sql = "SELECT * FROM mau_sacs
        WHERE id_chi_tiet_san_pham   = $id";
        $result = $this->conn->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete_san_pham($id)
    {
        $sql = "DELETE FROM san_phams WHERE id_san_pham  = $id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }












}
