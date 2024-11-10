<?php
    class KhachHang_ctl
    {
        public function khach_hang()
        {
            $data = (new KhachHang())->all();
            view("khachhang", ['data' => $data]);
        }
        public function ct_khach_hang()
        {
            $id = $_GET['id']; // Lấy id từ URL
            $khachHangModel = new KhachHang();
            $data = $khachHangModel->find($id);
            view("ct_khachhang", ['data' => $data]);
        }
    }
?>