<?php
class TaiKhoan_ctl
{
    public function update_khach_hang()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['id_khach_hang'];
            $khachHangModel = new TaiKhoan();
            $data_acc = $khachHangModel->find($id);
            $anh_dai_dien = "";
            $file_anh = $_FILES['anh_dai_dien'];

            $data = $_POST;

            if ($file_anh['size'] > 0) {
                $anh_dai_dien = "image/" . basename($file_anh['name']);
                move_uploaded_file($file_anh['tmp_name'], $anh_dai_dien);
            } else {
                $anh_dai_dien = $data_acc['anh_dai_dien'];
            }
            $data['anh_dai_dien'] = $anh_dai_dien;




            $errors = [];
            if (empty(trim($data['tens']))) {
                $errors[] = "Tên không được để trống.";
            }
            if (empty(trim($data['email'])) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email không hợp lệ.";
            }
            if (empty(trim($data['so_dien_thoai'])) || !preg_match('/^[0-9]{10,11}$/', $data['so_dien_thoai'])) {
                $errors[] = "Số điện thoại không hợp lệ.";
            }
            if (empty(trim($data['dia_chi']))) {
                $errors[] = "Địa chỉ không được để trống.";
            }

            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors);

                header("location: index.php?act=thong_tin_ca_nhan");
                exit();
            }


            if ((new TaiKhoan())->update($id, $data)) {
                $_SESSION['success'] = "Cập nhật thông tin thành công.";
                header("location: index.php?act=thong_tin_ca_nhan");
                exit();
            }
        } else {
            $id = $_SESSION['id_khach_hang'];
            $danh_muc = (new Md_danh_muc())->all();
            $khachHangModel = new TaiKhoan();
            $data = $khachHangModel->find($id);
            view("TaiKhoan/ThongTin", ['data' => $data, 'danh_muc' => $danh_muc]);
        }
    }

    public function doi_mat_khau()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy thông tin người dùng từ session
            $id = $_SESSION['id_khach_hang'];
            $mat_khau_cu = $_POST['mat_khau_cu'];
            $mat_khau_moi = $_POST['mat_khau_moi'];
            $mat_khau_moi_nhap_lai = $_POST['mat_khau_moi_nhap_lai'];

            // Kiểm tra mật khẩu mới và mật khẩu nhập lại có khớp không
            if ($mat_khau_moi !== $mat_khau_moi_nhap_lai) {
                // Nếu không khớp, thông báo lỗi
                $_SESSION['error'] = "Mật khẩu mới và mật khẩu nhập lại không khớp.";
                view("TaiKhoan/DoiMatKhau");
                return;
            }

            // Kiểm tra mật khẩu cũ có đúng không
            $taiKhoanModel = new TaiKhoan();
            $userData = $taiKhoanModel->find($id); // Lấy thông tin người dùng từ DB
            if ($userData['mat_khau'] !== $mat_khau_cu) {
                // Nếu mật khẩu cũ không đúng
                $_SESSION['error'] = "Mật khẩu cũ không đúng.";
                view("TaiKhoan/DoiMatKhau");
                return;
            }

            // Cập nhật mật khẩu mới
            if ($userData['mat_khau'] == $mat_khau_cu && $mat_khau_moi === $mat_khau_moi_nhap_lai) {
                $taiKhoanModel->update_mat_khau($id, $mat_khau_moi);
                echo "<script type='text/javascript'>
                window.location.href = 'index.php?act=thong_tin_ca_nhan';
            </script>";
                $_SESSION['success'] = "Mật khẩu đã được thay đổi thành công!";

                exit();
            }
        } else {

            view("TaiKhoan/DoiMatKhau");
        }
    }
}
