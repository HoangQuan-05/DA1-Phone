<?php

class lien_he
{
    public $conn = null;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function hien_thi_tin_nhan($id_nguoi_gui, $id_nguoi_nhan)
    {
        $sql  = "SELECT * FROM tin_nhan 
                JOIN khach_hang ON  tin_nhan.id_nguoi_gui = khach_hang.id_khach_hang
                  WHERE (id_nguoi_gui = :id_nguoi_gui AND id_nguoi_nhan = :id_nguoi_nhan) 
                     OR (id_nguoi_gui = :id_nguoi_nhan AND id_nguoi_nhan = :id_nguoi_gui) 
                  ORDER BY thoi_gian";

        $result = $this->conn->prepare($sql);
        // Thực thi truy vấn và truyền giá trị cho các tham số
        $result->execute(['id_nguoi_gui' => $id_nguoi_gui, 'id_nguoi_nhan' => $id_nguoi_nhan]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function tin_nhan_khach_hang($id_nguoi_nhan)
    {
        $sql  = "SELECT tin_nhan.*, khach_hang.*
              FROM tin_nhan 
              JOIN khach_hang ON tin_nhan.id_nguoi_gui = khach_hang.id_khach_hang
              WHERE tin_nhan.id_nguoi_nhan = :id_nguoi_nhan
              AND tin_nhan.thoi_gian = (
                  SELECT MAX(thoi_gian) 
                  FROM tin_nhan AS t 
                  WHERE t.id_nguoi_gui = tin_nhan.id_nguoi_gui 
                  AND t.id_nguoi_nhan = :id_nguoi_nhan 
              )
              ORDER BY tin_nhan.thoi_gian DESC";
        //Lấy ra thời gian gần nhất
        //Đổi tên bảng con
        //Lấy ra id  người gửi
        //Lấy ra id người nhận được chỉ định
        $result = $this->conn->prepare($sql);
        // Thực thi truy vấn và truyền giá trị cho các tham số
        $result->execute(['id_nguoi_nhan' => $id_nguoi_nhan]);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
