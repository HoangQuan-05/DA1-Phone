<?php
class KhachHang_ctl
{
    public function khach_hang()
    {
        $data = (new KhachHang())->all();
        view("khachhang", ['data' => $data]);
    }


    public function dl_khach_hang()
    {
        $id = $_GET['id'];
        (new KhachHang())->delete($id);
        header("Location: index.php?act=khachhang");
        exit();
    }

    public function add_khach_hang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $anh_dai_dien = "";
            $file_anh = $_FILES['anh_dai_dien'];
            $data["vai_tro"] = "khach hang ";
           

            if ($file_anh['size'] > 0) {
                $anh_dai_dien = "image/" . basename($file_anh['name']);
                move_uploaded_file($file_anh['tmp_name'], $anh_dai_dien);
            }

            $data['anh_dai_dien'] = $anh_dai_dien;
            (new KhachHang())->create($data);
            header("Location: index.php?act=khachhang");
            exit();
        } else {
            view("add_khachhang");
        }
    }

    public function update_khach_hang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'];
            $data = $_POST;
            $anh_dai_dien = "";
            $file_anh = $_FILES['anh_dai_dien'];
            $du_lieu_avt = (new KhachHang())->find($id);
            if ($file_anh['size'] > 0) {
                $anh_dai_dien = "image/" . basename($file_anh['name']);
                move_uploaded_file($file_anh['tmp_name'], $anh_dai_dien);
                $data['anh_dai_dien'] = $anh_dai_dien;
            }else{
                $data['anh_dai_dien'] = $du_lieu_avt['anh_dai_dien'];
            }

            (new KhachHang())->update($id, $data);
            header("Location: index.php?act=khachhang");
            exit();
        } else {
            $id = $_GET['id'];
            $khachHangModel = new KhachHang();
            $data = $khachHangModel->find($id);
            view("update_khachhang", ['data' => $data]);
        }
    }
}
