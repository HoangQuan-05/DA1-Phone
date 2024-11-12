<?php

class Ctl_san_pham
{
    public function show()
    {
        $data = (new Md_san_pham())->show();
        $anh = (new Md_san_pham())->show_anh();
        view('san_pham/hien_thi', ['data' => $data, 'anh' => $anh]);
    }

    public function them_san_pham()
    {
        $danh_muc = (new DanhMuc())->all();
        view('san_pham/add', ['danh_muc' => $danh_muc]);



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST['phien_ban'] as $index => $value) {
                $stt_phien_ban = $index;
            }
            foreach ($_POST['so_luong'] as $index => $value) {
                $stt_sl = false;
                $stt_so_luong = $index;
                if (is_numeric($value)) {
                    $stt_sl = true;
                }
            }
            foreach ($_POST['gia_ban'] as $index => $value) {
                $stt_gia = false;
                $stt_gia_ban = $index;
                if (is_numeric($value)) {
                    $stt_gia = true;
                }
            }
            foreach ($_POST['mau_sac'] as $index => $value) {
                $stt_mau_sac = $index;
            }

            if ($_POST['ten_san_pham'] != "") {
                if ($_POST['id_danh_muc'] != 0) {
                    if ($_POST['phien_ban'][0] != "") {
                        if ($_POST['mau_sac'][0] != "") {
                            if ($_POST['gia_ban'][0] != "") {
                                if ($_POST['so_luong'][0] != "") {

                                    if ($stt_phien_ban ==  $stt_so_luong &&  $stt_gia_ban == $stt_mau_sac &&  $stt_mau_sac == $stt_phien_ban && $stt_sl == true && $stt_gia == true) {

                                        $du_lieu_sp = [];
                                        $du_lieu_bien_the = [];
                                        $du_lieu_phien_ban = [];
                                        $data = $_POST;
                                        $data['luot_xem'] = 0;

                                        $img = [];
                                        $file_anh = $_FILES['hinh_anh'];

                                        if (isset($file_anh['name']) && count($file_anh['name']) > 0) {
                                            foreach ($file_anh['name'] as $index => $value) {
                                                if ($file_anh['size'][$index] > 0) {
                                                    $path_img = "image/" . $value;
                                                    if (move_uploaded_file($file_anh['tmp_name'][$index], $path_img)) {
                                                        $img[] = $value;
                                                    }
                                                }
                                            }

                                            $data['hinh_anh'] = $img;
                                        } else {
                                            $data['hinh_anh'] = "";
                                        }

                                        $du_lieu_sp = [
                                            'ten_san_pham' => $data['ten_san_pham'],
                                            'id_danh_muc'  => $data['id_danh_muc'],
                                            'mo_ta_ngan'   => $data['mo_ta_ngan'],
                                            'mo_ta_dai'    => $data['mo_ta_dai'],
                                            'luot_xem'     => $data['luot_xem'],
                                        ];
                                        (new Md_san_pham())->creat_san_pham($du_lieu_sp);

                                        $new_id = (new Md_san_pham())->find_one_time();
                                        $id_sp = $new_id['id_san_pham'];  // LẤY ID CỦA SẢN PHẨM


                                        $all_img = $data['hinh_anh'];
                                        foreach ($all_img as $value) {
                                            $hinh_anhs['id_san_pham'] = $id_sp;
                                            $hinh_anhs['hinh_anh'] = $value;
                                            (new Md_san_pham())->creat_hinh_anh($hinh_anhs); // THÊM HÌNH ẢNH


                                        }


                                        $du_lieu_bien_the['id_san_pham'] = $id_sp;

                                        $gia_ban = $data['gia_ban'];
                                        $so_luong = $data['so_luong'];

                                        foreach ($gia_ban as $index => $value) { // GIÁ BÁN
                                            foreach ($so_luong as $index2 => $value2) { //SỐ LƯỢNG
                                                if ($index == $index2 && $value != "" && $value2 != "") {

                                                    $du_lieu_bien_the['so_luong'] = $value2;
                                                    $du_lieu_bien_the['gia_ban'] = $value;

                                                    (new Md_san_pham())->creat_chi_tiet_san_pham($du_lieu_bien_the);

                                                    $if_sp_ct = (new Md_san_pham())->find_one_time_chi_tiet();
                                                    $id_sp_ct = $if_sp_ct['id'];
                                                    $du_lieu_phien_ban = $data['phien_ban'];
                                                    $du_lieu_mau_sac = $data['mau_sac'];


                                                    foreach ($du_lieu_phien_ban as $index3 => $value3) { //PHIÊN BẢN
                                                        if ($index3 == $index && $index3 == $index2 && $value2 != "" && $value3 != "") {

                                                            $dl_pb['id_chi_tiet_san_pham']  = $id_sp_ct;
                                                            $dl_pb['phien_ban'] = $value3;

                                                            (new Md_san_pham())->creat_phien_ban($dl_pb);

                                                            break;
                                                        }
                                                    }
                                                    foreach ($du_lieu_mau_sac as  $index4 => $value4) { //MÀU SẮC
                                                        if ($index4 == $index && $index4 == $index2 && $value2 != "" && $value4 != "" && $index3 == $index4) {
                                                            $dl_ms['id_chi_tiet_san_pham']  = $id_sp_ct;
                                                            $dl_ms['mau_sac'] = $value4;
                                                            (new Md_san_pham())->creat_mau_sac($dl_ms);
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        echo "<script type='text/javascript'>
                                                window.location.href = 'index.php?act=san_pham';
                                            </script>";
                                    } else {
                                        echo "<script type='text/javascript'>
                                    er_san_pham.innerText = 'Nhập lại biến thể';
                                  </script>";
                                    }
                                } else {
                                    echo "<script type='text/javascript'>
                                    er_san_pham.innerText = 'Chưa sô lượng';
                                  </script>";
                                }
                            } else {
                                echo "<script type='text/javascript'>
                                er_san_pham.innerText = 'Chưa nhập giá bán';
                              </script>";
                            }
                        } else {
                            echo "<script type='text/javascript'>
                            er_san_pham.innerText = 'Chưa nhập màu sắc';
                          </script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>
                        er_san_pham.innerText = 'Chưa nhập cấu hình';
                      </script>";
                    }
                } else {
                    echo "<script type='text/javascript'>
                    er_san_pham.innerText = 'Chưa chọn danh mục';
                  </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                er_san_pham.innerText = 'Chưa nhập tên sản phẩm';
              </script>";
            }
        }
    }









    public function update_san_pham()
    {
        $id = $_GET['id'];
        $data = (new Md_san_pham())->find_one($id);
        $danh_muc = (new DanhMuc())->all();
        $anhs = (new Md_san_pham())->show_anh_san_pham($id);
        $sp_chi_tiet = (new Md_san_pham())->find_one_sp_chi_tiet($id);

        $all_phien_ban = [];
        $all_mau_sac = [];

        foreach ($sp_chi_tiet as $value) {
            $phien_ban = (new Md_san_pham())->find_one_phien_ban($value['id']);
            foreach ($phien_ban as $value2) {
                $all_phien_ban[] = $value2;
            }
            $mau_sac = (new Md_san_pham())->find_one_mau_sac($value['id']);
            foreach ($mau_sac as $value3) {
                $all_mau_sac[] = $value3;
            }
        }

        view('san_pham/update', ['data' => $data, 'danh_muc' => $danh_muc, 'anhs' => $anhs, 'sp_chi_tiet' => $sp_chi_tiet, 'all_phien_ban' => $all_phien_ban, 'all_mau_sac' => $all_mau_sac]);


        //CẬP NHẬT ẢNH
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $img = [];
            //LẤY DỮ LIỆU ẢNH CŨ
            $data_anh = (new Md_san_pham())->show_anh_san_pham($id);
            $file_anh = $_FILES['hinh_anh'];

            if ($file_anh['size'][0] > 0) {
                foreach ($file_anh['name'] as $index => $value) {
                    $img[] = $value; //LƯU ẢNH MỚI VÀO MẢNG
                }

                //CẬP NHẬT ẢNH MỚI 
                foreach ($data_anh as $index1 => $value1) {
                    $du_lieu_anh['id'] = $value1['id'];
                    foreach ($img as $index3 => $value3) {
                        if ($index1 == $index3) {
                            $du_lieu_anh['hinh_anh'] = $value3;
                            $path_img = "image/" . $value3;
                            move_uploaded_file($file_anh['tmp_name'][$index3], $path_img);
                            (new Md_san_pham())->update_hinh_anh($du_lieu_anh);
                            break;
                        }
                    }
                }
            }
            if (empty($data_anh)) {
                $img = [];
                $file_anh = $_FILES['hinh_anh'];

                if (isset($file_anh['name']) && count($file_anh['name']) > 0) {
                    foreach ($file_anh['name'] as $index => $value) {
                        if ($file_anh['size'][$index] > 0) {
                            $path_img = "image/" . $value;
                            if (move_uploaded_file($file_anh['tmp_name'][$index], $path_img)) {
                                $img[] = $value;
                            }
                        }
                    }

                    $data['hinh_anh'] = $img;
                } else {
                    $data['hinh_anh'] = "";
                }
                $all_img = $data['hinh_anh'];
                foreach ($all_img as $value) {
                    $hinh_anhs['id_san_pham'] = $id;
                    $hinh_anhs['hinh_anh'] = $value;
                    (new Md_san_pham())->creat_hinh_anh($hinh_anhs); // THÊM HÌNH ẢNH


                }
            }




            $stt = true;
            foreach ($_POST['so_luong'] as $index => $value) {
                if ($value == "") {
                    $stt = false;
                }
            }
            foreach ($_POST['gia_ban'] as $index => $value) {
                if ($value == "") {
                    $stt = false;
                }
            }

            if ($_POST['ten_san_pham'] != "") {
                if ($_POST['gia_ban'][0] != "") {
                    if ($_POST['so_luong'][0] != "") {
                        if ($stt) {



                            //UPDATE SẢN PHẨM
                            $du_lieu_sp = [
                                'ten_san_pham' => $_POST['ten_san_pham'],
                                'id_danh_muc'  => $_POST['id_danh_muc'],
                                'mo_ta_ngan'   => $_POST['mo_ta_ngan'],
                                'mo_ta_dai'    => $_POST['mo_ta_dai'],
                            ];

                            (new Md_san_pham())->update_sanpham($id, $du_lieu_sp);

                            // UPDATE SẢN PHẨM CHI TIẾT
                            $du_lieu_bien_the['so_luong'] = $_POST['so_luong'];
                            $du_lieu_bien_the['gia_ban'] = $_POST['gia_ban'];


                            foreach ($sp_chi_tiet as $index3 => $id_chi_tiet) {
                                $stt = false;
                                foreach ($du_lieu_bien_the['so_luong'] as $index => $value) {
                                    if ($index3 == $index) {
                                        foreach ($du_lieu_bien_the['gia_ban'] as $index1 => $value1) {

                                            if ($index == $index1) {
                                                $update_bien_the['so_luong'] = $value;
                                                $update_bien_the['gia_ban'] = $value1;
                                                (new Md_san_pham())->update_san_pham_chi_tiet($id_chi_tiet['id'], $update_bien_the);
                                                $stt = true;
                                                break;
                                            }
                                        }
                                    }
                                    if ($stt) {
                                        break;
                                    }
                                }
                            }
                            echo "<script type='text/javascript'>
                                    window.location.href = 'index.php?act=san_pham';
                                </script>";
                        } else {
                            echo "<script type='text/javascript'>
                            er_san_pham.innerText = 'Giá bán hoặc số lượng không được để trống';
                          </script>";
                        }
                    } else {
                        echo "<script type='text/javascript'>
                        er_san_pham.innerText = 'Chưa sô lượng';
                      </script>";
                    }
                } else {
                    echo "<script type='text/javascript'>
                er_san_pham.innerText = 'Chưa nhập giá bán';
              </script>";
                }
            } else {
                echo "<script type='text/javascript'>
                er_san_pham.innerText = 'Chưa nhập tên sản phẩm';
              </script>";
            }
        }
    }

    public function delete_san_pham()
    {
        $id = $_GET['id'];
        $data = (new Md_san_pham())->show_anh_san_pham($id);

        foreach ($data as $value) {
            $img[] = $value['hinh_anh'];
        }
        foreach ($img as $value1) {
            unlink("image/".$value1);
        }
            (new Md_san_pham())->delete_san_pham($id);
            echo "<script type='text/javascript'>
            window.location.href = 'index.php?act=san_pham';
        </script>";
    }
}
