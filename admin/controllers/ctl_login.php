<?php

class loginController
{
    //ĐĂNG NHẬP
    public function login()
    {
        $results = (new KhachHang())->all();
        view("dang_nhap/login");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stt = false;
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                foreach ($results as $user) {
                    if ($_POST['email'] == $user['email'] && $_POST['mat_khau'] == $user['mat_khau']) {
                        $stt = true;
                        $_SESSION['id_khach_hang'] = $user['id_khach_hang'];
                        $_SESSION['name_khach_hang'] = $user['tens'];
                        $_SESSION['avt'] = $user['anh_dai_dien'];
                        $_SESSION['vai_tro'] = $user['vai_tro'];

                        if ($user['vai_tro'] == "nhan vien") {
                            header("Location: admin/index.php?act=dashboard");
                        } else {
                            header("Location: ../index.php");
                        }
                        exit();
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
    //ĐĂNG KÝ
    public function register()
    {
        view("dang_nhap/register");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $anh_dai_dien = "";
            $file_anh = $_FILES['anh_dai_dien'];
            $data["vai_tro"] = "khach hang";

            if ($file_anh['size'] > 0) {
                $anh_dai_dien = "image/" . basename($file_anh['name']);
                move_uploaded_file($file_anh['tmp_name'], $anh_dai_dien);
            }

            $data['anh_dai_dien'] = $anh_dai_dien;

            if (!empty($data['tens']) && !empty($data['email']) && !empty($data['mat_khau']) && !empty($data['so_dien_thoai']) && !empty($data['ngay_sinh']) && !empty($data['dia_chi'])) {
                if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    if (strlen($data['so_dien_thoai']) == 10) {
                        $khachHang = new KhachHang();
                        $result = $khachHang->dang_ky($data);

                        if ($result) {
                            echo "<script type='text/javascript'>
                                alert('Đăng ký thành công!');
                                window.location.href = 'index.php?act=login';
                              </script>";
                        } else {
                            echo "<script type='text/javascript'>
                                document.getElementById('er_reg').innerText = 'Đăng ký thất bại. Vui lòng thử lại.';
                              </script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>
                            document.getElementById('er_reg').innerText = 'Số điện thoại không hợp lệ';
                          </script>";
                    }
                } else {
                    echo "<script type='text/javascript'>
                        document.getElementById('er_reg').innerText = 'Định dạng email không hợp lệ';
                      </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                    document.getElementById('er_reg').innerText = 'Vui lòng điền đầy đủ thông tin';
                  </script>";
            }
        }
    }
    public function log_out()
    {
        session_unset();
        header("Location: index.php");
    }
}
