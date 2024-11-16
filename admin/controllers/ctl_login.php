<?php

class loginController
{
    //ĐĂNG NHẬP
    public function login()
    {

        $results = (new KhachHang())->all();
        view("dang_nhap/login");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stt = false; // Initialize the status flag
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                foreach ($results as $user) {
                    if ($_POST['email'] == $user['email'] && $_POST['mat_khau'] == $user['mat_khau'] && $user['vai_tro'] == "nhan vien") {
                        $stt = true;
                        $_SESSION['id_khach_hang'] = $user['id_khach_hang'];
                        $_SESSION['name_khach_hang'] = $user['tens'];
                        $_SESSION['avt'] = $user['anh_dai_dien'];
                        header("Location: index.php?act=dashboard");
                    }
                }

                if (!$stt) {
                    echo "<script type='text/javascript'>
                            document.getElementById('er_reg').innerText = 'Email hoặc mật khẩu sai';
                          </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                        document.getElementById('er_reg').innerText = 'Định dạng email không hợp lệ';
                      </script>";
            }
        }
        
    }



    public function log_out()
    {
        session_unset();
        header("Location: index.php?act=login");
    }
}
