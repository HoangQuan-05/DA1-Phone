<?php

class trang_thai_ctl
{


    public function trangthai()
    {
        $trangthais = (new trangthais())->all(); // Giả sử class trangthais đã được định nghĩa

        views("trang_thai_don_hang/trang_thai", ['trangthais' => $trangthais]); // Truyền dữ liệu $trangthais vào view trangthais.php
    }

    public function delete_tt()
    {
        $id = $_GET['id'];
        (new trangthais())->delete($id);
        header("location:index.php?act=trang_thai");
    }

    public function add_tt()
    {
        views("trang_thai_don_hang/add_trang_thai");
    }
    public function store_tt()
    {
        $data = $_POST;
       
        (new trangthais())->insert($data);
        header("Location: index.php?act=trang_thai");
    }
    public function update_tt()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = $_POST;
           
            (new trangthais())->update($data);
            header("Location: index.php?act=trang_thai");
        }
        $id = $_GET['id'];
        $trangthais = (new trangthais())->find_one($id);
        views("trang_thai_don_hang/update_trang_thai", ['trangthais' => $trangthais]);
    }
}
