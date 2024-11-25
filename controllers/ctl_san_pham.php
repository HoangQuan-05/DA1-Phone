<?php

class SanPham
{
    public function san_pham()
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($_GET['page'] <= 0) {
                $page = 1;
            }
            $offset = ($page - 1) * 32;
            $count = (new Md_san_pham())->count_SanPham();
        } else {
            $count = 0;
            $page = 1;
            $offset = 0;
        }
        $san_pham = (new Md_san_pham())->show_all_san_pham($offset);

        if (isset($_GET['by'])) {
            $min_max = (new Md_san_pham())->show_san_pham_min($_GET['by'], $offset);
        } else {
            $min_max = [];
        }

        if (isset($_GET['danh_muc'])) {
            $sp_danh_muc = (new Md_san_pham())->show_san_pham_danh_muc($_GET['danh_muc'], $offset);
        } else {
            $sp_danh_muc = [];
        }


        $danh_muc = (new Md_danh_muc())->all();
        view('SanPham/SanPham', ['san_pham' => $san_pham, 'danh_muc' => $danh_muc, 'count' => $count, 'min_max' => $min_max, 'sp_danh_muc' => $sp_danh_muc]);
    }


    public function chi_tiet_san_pham()
    {
        $id = $_GET['id'];

        $danh_muc = (new Md_danh_muc())->all();
        $san_pham = (new Md_san_pham())->san_pham_chi_tiet($id);
        $hinh_anh = (new Md_san_pham())->hinh_anh($id);
        $bien_the = (new Md_san_pham())->bien_the_san_pham($id);
        $tham_khao = (new Md_san_pham())->show_all_san_pham(0);


        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            echo "Không tìm thấy sản phẩm";
            return;
        }

        $md_san_pham = new Md_san_pham();
        $data = $md_san_pham->find_one($id);
        if (!$data) {
            echo "Không tìm thấy sản phẩm";
            return;
        }

        // Xử lý thêm bình luận
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['binh_luan'])) {
            if (!isset($_SESSION['id_khach_hang'])) {
                echo "<script type='text/javascript'>
                alert('Cần đăng nhập để bình luận');
                window.location.href = 'index.php?act=chi_tiet_san_pham&id= $id';
                </script>";
                return;
            }

            $noi_dung = trim($_POST['noi_dung']);
            if (empty($noi_dung)) {
                echo "Nội dung bình luận không được để trống.";
                return;
            }

            (new BinhLuan())->themBinhLuan($_SESSION['id_khach_hang'], $id, $noi_dung);
            header("Location: index.php?act=chi_tiet_san_pham&id=" . $id);
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['danh_gias'])) {
            // Kiểm tra người dùng đã đăng nhập chưa
            if (!isset($_SESSION['id_khach_hang'])) {
                // header("Location: index.php?act=dang_nhap&redirect=chi_tiet_san_pham&id=" . $id);
                echo "<script type='text/javascript'>
                        alert('Cần đăng nhập để đánh giá');
                        window.location.href = 'index.php?act=chi_tiet_san_pham&id= $id';
                        </script>";

                exit();
            }

            // Lấy dữ liệu từ form
            $diem_danh_gia = $_POST['diem_danh_gia'];
            $noi_dung = trim($_POST['noi_dung']);
            $id_khach_hang = $_SESSION['id_khach_hang'];

            // Kiểm tra dữ liệu hợp lệ


            // Thêm đánh giá vào cơ sở dữ liệu
            $result = (new Md_san_pham())->add_danh_gia($id, $id_khach_hang, $diem_danh_gia, $noi_dung);

            if ($result) {
                header("Location: index.php?act=chi_tiet_san_pham&id=" . $id);
                exit();
            } else {
                echo "Có lỗi khi thêm đánh giá.";
            }
        }

        // Lấy bình luận và đánh giá
        $binh_luan = $md_san_pham->get_binh_luan_by_san_pham_id($id);
        $total_binh_luan = $md_san_pham->count_binh_luan_by_san_pham_id($id);
        $danh_gia = $md_san_pham->get_danh_gia_by_san_pham_id($id);

        // Tính điểm trung bình đánh giá
        $tong_diem = array_sum(array_column($danh_gia, 'diem_danh_gia'));
        $so_luong_danh_gia = count($danh_gia);
        $diem_trung_binh = $so_luong_danh_gia > 0 ? round($tong_diem / $so_luong_danh_gia, 1) : 0;



        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add__product']) && isset($_SESSION['id_khach_hang']) && isset($_POST['id_san_pham_chi_tiet'])) {
            $stt = true;
            $data_gio_hang['id_khach_hang'] = $_SESSION['id_khach_hang'];
            $data_gio_hang['id_san_pham_chi_tiet'] = $_POST['id_san_pham_chi_tiet'];
            $data_gio_hang['so_luong'] = $_POST['so_luong_mua'];

            $san_pham_gio_hang = (new Md_Gio_Hang)->find_all($data_gio_hang['id_khach_hang']);

            foreach ($san_pham_gio_hang as $value) {
                if ($value['id_san_pham_chi_tiet'] == $data_gio_hang['id_san_pham_chi_tiet']) {
                    $stt = false;
                    $data_gio_hang['so_luong'] += $value['so_luong_mua'];
                    foreach ($bien_the as $value2) {
                        if ($value2['id'] == $value['id_san_pham_chi_tiet']) {
                            if ($data_gio_hang['so_luong'] <= $value2['so_luong']) {
                                (new Md_Gio_Hang())->update_gio_hang($value['id_san_pham_chi_tiet'], $data_gio_hang['id_khach_hang'], $data_gio_hang['so_luong']);
                            } else {
                                (new Md_Gio_Hang())->update_gio_hang($value['id_san_pham_chi_tiet'], $data_gio_hang['id_khach_hang'], $value2['so_luong']);
                            }
                        }
                    }
                }
            }


            if ($stt && (new Md_Gio_Hang)->add_gio_hang($data_gio_hang)) {
                echo "<script type='text/javascript'>
                    window.location.href = 'index.php?act=chi_tiet_san_pham&id=$id';
                </script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy__product']) && isset($_SESSION['id_khach_hang']) && isset($_POST['id_san_pham_chi_tiet'])) {
            $stt = true;
            $_SESSION['buy__product'] = $_POST['buy__product'];
            $_SESSION['id_san_pham_chi_tiet'] = $_POST['id_san_pham_chi_tiet'];

            $data_gio_hang['id_khach_hang'] = $_SESSION['id_khach_hang'];
            $data_gio_hang['id_san_pham_chi_tiet'] = $_POST['id_san_pham_chi_tiet'];
            $data_gio_hang['so_luong'] = $_POST['so_luong_mua'];

            $san_pham_gio_hang = (new Md_Gio_Hang)->find_all($data_gio_hang['id_khach_hang']);

            foreach ($san_pham_gio_hang as $value) {
                if ($value['id_san_pham_chi_tiet'] == $data_gio_hang['id_san_pham_chi_tiet']) {
                    $stt = false;
                    $data_gio_hang['so_luong'] += $value['so_luong_mua'];
                    foreach ($bien_the as $value2) {
                        if ($value2['id'] == $value['id_san_pham_chi_tiet']) {
                            if ($data_gio_hang['so_luong'] <= $value2['so_luong']) {
                                (new Md_Gio_Hang())->update_gio_hang($value['id_san_pham_chi_tiet'], $data_gio_hang['id_khach_hang'], $data_gio_hang['so_luong']);
                                echo "<script type='text/javascript'>
                                        window.location.href = 'index.php?act=gio_hang';
                                    </script>";
                            } else {
                                (new Md_Gio_Hang())->update_gio_hang($value['id_san_pham_chi_tiet'], $data_gio_hang['id_khach_hang'], $value2['so_luong']);
                                echo "<script type='text/javascript'>
                                        window.location.href = 'index.php?act=gio_hang';
                                    </script>";
                            }
                        }
                    }
                }
            }
           

            if ($stt && (new Md_Gio_Hang)->add_gio_hang($data_gio_hang)) {

                echo "<script type='text/javascript'>
                    window.location.href = 'index.php?act=gio_hang';
                </script>";
            }
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['id_san_pham_chi_tiet'])) {
            echo "<script type='text/javascript'>
                     alert('chon phien ban');
                </script>";
        }





        view("SanPham/ChiTietSanPham", [
            'san_pham' => $san_pham,
            'bien_the' => $bien_the,
            'hinh_anh' => $hinh_anh,
            'tham_khao' => $tham_khao,
            'danh_muc' => $danh_muc,
            'data' => $data,
            'binh_luan' => $binh_luan,
            'danh_gia' => $danh_gia,
            'diem_trung_binh' => $diem_trung_binh,
            'so_luong_danh_gia' => $so_luong_danh_gia,
            'total_binh_luan' => $total_binh_luan,
        ]);
    }
}
