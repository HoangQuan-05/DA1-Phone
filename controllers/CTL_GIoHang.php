<?php

class Gio_Hang
{
    public function gio_hang()
    {
        ob_start(); // Bật bộ đệm đầu ra

        if (isset($_SESSION['id_khach_hang'])) {
            $id_khach_hang = $_SESSION['id_khach_hang'];
            $sanpham_giohang = (new Md_Gio_Hang)->find_all($id_khach_hang);
            view('GioHang', ['sanpham_giohang' => $sanpham_giohang]);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['update']) && $_POST['update'] == 0) {
                    foreach ($_POST['san_pham'] as $duLieu) {
                        list($id_san_pham_CT, $so_luong_mua) = explode('|', $duLieu);
                        (new Md_Gio_Hang())->update_gio_hang($id_san_pham_CT, $id_khach_hang, $so_luong_mua);
                    }
                    echo "<script type='text/javascript'>
                        window.location.href = 'index.php?act=gio_hang';
                    </script>";
                }
                if (isset($_POST['buy']) && $_POST['buy'] == 1 && isset($_POST['san_pham'])) {
                    ob_end_clean();

                    $_SESSION['san_pham'] = $_POST['san_pham'];
                    header("location: index.php?act=thanh_toan");
                    exit;
                }
            }
        } else {
            echo "<script type='text/javascript'>
                     alert('Chưa đăng nhập');
                </script>";
            echo "<script type='text/javascript'>
                window.location.href = 'index.php';
            </script>";
        }
    }


    public function delete_gio_hang()
    {
        $id = $_GET['idsp'];
        $id_khach_hang = $_GET['idkh'];
        (new Md_Gio_Hang())->delete($id, $id_khach_hang);
        echo "<script type='text/javascript'>
                    window.location.href = 'index.php?act=gio_hang';
            </script>";
    }
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }



    public function thanh_toan()
    {
        function hienThiThongBao()
        {
            echo "<script type='text/javascript'>
               setTimeout(() => {
                    Swal.fire({
                        title: 'Mua thành công!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Chuyển hướng đến trang khác sau khi nhấn OK
                            window.location.href = 'index.php?act=don_hang';
                        }
                        });
                }, 100);
                </script>";
        }


        //MUA HÀNG TỪ GIỎ HÀNG
        if (isset($_SESSION['san_pham'])) {

            $array_san_pham = [];
            $data_nhan_hang = (new Md_Gio_Hang())->khach_hang($_SESSION['id_khach_hang']);

            $voucher = (new Md_Gio_Hang())->voucher();
            $ma_don_hang = mt_rand(10000, 99999);
            foreach ($_SESSION['san_pham'] as $values) {
                list($id, $soluong) = explode('|', $values);
                (new Md_Gio_Hang())->update_gio_hang($id, $_SESSION['id_khach_hang'], $soluong);
                $array_san_pham[] = (new Md_Gio_Hang())->don_hang($_SESSION['id_khach_hang'], $id);
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['payUrl']) && $_POST['payUrl'] == 'COD') {
                    $hoa_don = $_POST;
                    $_SESSION['thanh_tien'] = $hoa_don['thanh_toan'];
                    $so_luong_c = [];

                    $hoa_don['ma_don_hang'] = $ma_don_hang;
                    $hoa_don['id_khach_hang'] = $_SESSION['id_khach_hang'];
                    $hoa_don['trang_thai_don_hang'] = 1;

                    foreach ($array_san_pham as $chi_tiet_hd) {
                        $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                        $soluong__[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);
                    }
                    $check_sl = false;
                    foreach ($soluong__ as $values2) {
                        if ($values2['so_luong'] > 0) {
                            $check_sl = true;
                        }
                    }
                    if ($check_sl) {

                        (new Md_Gio_Hang())->insert_hoa_don($hoa_don);
                        $find_hd = (new Md_Gio_Hang())->hd();

                        foreach ($array_san_pham as $chi_tiet_hd) {
                            $dh_ct['id_hoa_don'] = $find_hd['id'];
                            $dh_ct['so_luong_mua'] = $chi_tiet_hd['so_luong_mua'];
                            $dh_ct['don_gia'] = $chi_tiet_hd['gia_ban'];
                            $dh_ct['thanh_tien'] = $chi_tiet_hd['gia_ban'] * $chi_tiet_hd['so_luong_mua'];
                            $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                            (new Md_Gio_Hang())->insert_hoa_don_ct($dh_ct);

                            $update_soluong[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);

                            $so_luong_c[] = $dh_ct['so_luong_mua'];
                        }

                        foreach ($array_san_pham as $delete) {
                            (new Md_Gio_Hang())->delete($delete['id_chi_tiet_san_pham'], $_SESSION['id_khach_hang']);
                            foreach ($update_soluong as $key => $update) {
                                if ($delete['id_chi_tiet_san_pham'] == $update['id']) {
                                    foreach ($so_luong_c as $key1 => $v2) {
                                        if ($key == $key1) {
                                            $sl_moi = $update['so_luong'] -  $v2;
                                            (new Md_san_pham())->update_sl_sp($delete['id_chi_tiet_san_pham'], $sl_moi);
                                        }
                                    }
                                }
                            }
                        }



                        $keep_sessions = ['id_khach_hang', 'name_khach_hang', 'avt', 'vai_tro'];

                        foreach ($_SESSION as $key => $value) {
                            if (!in_array($key, $keep_sessions)) {
                                unset($_SESSION[$key]); // Xóa các session không cần thiết
                            }
                        }

                        hienThiThongBao();
                        gui_email_phpmailer($_POST['email_nguoi_nhan'], "Đặt hàng thành công", "<h1>Sản phẩm sẽ sớm được giao đến bạn</h1>");
                    }
                } elseif (isset($_POST['payUrl']) && $_POST['payUrl'] == 'MOMO') {
                    if (isset($_POST['ten_nguoi_nhan'])) {
                        $_SESSION['momo'] = $_POST;
                        $_SESSION['momo']['trang_thai_thanh_toan'] = 'Đã thanh toán';
                    }


                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                    $partnercode = 'MOMOBKUN20180529';
                    $accesskey = 'klm05TvNBzhg7h7j';
                    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

                    $orderinfo = "Thanh toán qua MoMo";
                    $amounT = $_SESSION['momo']['thanh_toan'];
                    $orderid = rand(10000, 99999);
                    $redirecturl = "http://localhost:3000/index.php?act=thanh_toan";
                    $ipnurl = "http://localhost:3000/index.php?act=thanh_toan";
                    $extradata = "";


                    if (!empty($_POST)) {
                        $partnerCode = $partnercode;
                        $accessKey = $accesskey;
                        $serectkey = $secretKey;
                        $orderId = $orderid;
                        $orderInfo = $orderinfo;
                        $amount = $amounT;
                        $ipnUrl = $ipnurl;
                        $redirectUrl = $redirecturl;
                        $extraData = isset($_POST["extraData"]) ? $_POST["extraData"] : ""; // Sửa lỗi Undefined

                        $requestId = time() . "";
                        $requestType = "payWithATM";

                        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                        $signature = hash_hmac("sha256", $rawHash, $serectkey);

                        $data = array(
                            'partnerCode' => $partnerCode,
                            'partnerName' => "Test",
                            "storeId" => "MomoTestStore",
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'redirectUrl' => $redirectUrl,
                            'ipnUrl' => $ipnUrl,
                            'lang' => 'vi',
                            'extraData' => $extraData,
                            'requestType' => $requestType,
                            'signature' => $signature
                        );

                        $result = (new Gio_Hang)->execPostRequest($endpoint, json_encode($data));
                        $jsonResult = json_decode($result, true);  // decode JSON

                        if (isset($jsonResult['payUrl'])) {
                            header('Location: ' . $jsonResult['payUrl']);
                        }
                    }
                    if (empty($extraData)) {
                        $errorMessage = "Lỗi: Không thể thực hiện thanh toán. Vui lòng thử lại.";
                        echo "<div class='alert alert-danger'>$errorMessage</div>";
                    }
                }
            }

            if (isset($_GET['resultCode']) && $_GET['resultCode'] == 0) {

                $hoa_don = $_SESSION['momo'];
                $_SESSION['thanh_tien'] = $hoa_don['thanh_toan'];
                $so_luong_c = [];

                $hoa_don['ma_don_hang'] = $_GET['orderId'];
                $hoa_don['id_khach_hang'] = $_SESSION['id_khach_hang'];
                $hoa_don['trang_thai_don_hang'] = 1;

                foreach ($array_san_pham as $chi_tiet_hd) {
                    $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                    $soluong__[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);
                }
                $check_sl = false;
                foreach ($soluong__ as $values2) {
                    if ($values2['so_luong'] > 0) {
                        $check_sl = true;
                    }
                }
                if ($check_sl) {

                    (new Md_Gio_Hang())->insert_hoa_don($hoa_don);
                    $find_hd = (new Md_Gio_Hang())->hd();

                    foreach ($array_san_pham as $chi_tiet_hd) {
                        $dh_ct['id_hoa_don'] = $find_hd['id'];
                        $dh_ct['so_luong_mua'] = $chi_tiet_hd['so_luong_mua'];
                        $dh_ct['don_gia'] = $chi_tiet_hd['gia_ban'];
                        $dh_ct['thanh_tien'] = $chi_tiet_hd['gia_ban'] * $chi_tiet_hd['so_luong_mua'];
                        $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                        (new Md_Gio_Hang())->insert_hoa_don_ct($dh_ct);

                        $update_soluong[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);

                        $so_luong_c[] = $dh_ct['so_luong_mua'];
                    }

                    foreach ($array_san_pham as $delete) {
                        (new Md_Gio_Hang())->delete($delete['id_chi_tiet_san_pham'], $_SESSION['id_khach_hang']);
                        foreach ($update_soluong as $key => $update) {
                            if ($delete['id_chi_tiet_san_pham'] == $update['id']) {
                                foreach ($so_luong_c as $key1 => $v2) {
                                    if ($key == $key1) {
                                        $sl_moi = $update['so_luong'] -  $v2;
                                        (new Md_san_pham())->update_sl_sp($delete['id_chi_tiet_san_pham'], $sl_moi);
                                    }
                                }
                            }
                        }
                    }



                    $keep_sessions = ['id_khach_hang', 'name_khach_hang', 'avt', 'vai_tro'];

                    foreach ($_SESSION as $key => $value) {
                        if (!in_array($key, $keep_sessions)) {
                            unset($_SESSION[$key]); // Xóa các session không cần thiết
                        }
                    }

                    hienThiThongBao();
                    gui_email_phpmailer($_POST['email_nguoi_nhan'], "Đặt hàng thành công", "<h1>Sản phẩm sẽ sớm được giao đến bạn</h1>");
                }
            }




            view('ThanhToan', ['array_san_pham' => $array_san_pham, 'voucher' => $voucher, 'data_nhan_hang' => $data_nhan_hang]);
        }
        //MUA HÀNG TRỰC TIẾP
        if (isset($_SESSION['id_san_pham_chi_tiet'])) {

            $array_san_pham = [];

            $array_san_pham[] = (new Md_Gio_Hang())->don_hang__one($_SESSION['id_san_pham_chi_tiet']);
            $array_san_pham[0]['so_luong_mua'] = $_SESSION['so_luong'];

            $data_nhan_hang = (new Md_Gio_Hang())->khach_hang($_SESSION['id_khach_hang']);

            $voucher = (new Md_Gio_Hang())->voucher();
            $ma_don_hang = mt_rand(10000, 99999);



            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (isset($_POST['payUrl']) && $_POST['payUrl'] == 'COD') {
                    $hoa_don = $_POST;
                    $_SESSION['thanh_tien'] = $hoa_don['thanh_toan'];
                    $so_luong_c = [];

                    $hoa_don['ma_don_hang'] = $ma_don_hang;
                    $hoa_don['id_khach_hang'] = $_SESSION['id_khach_hang'];
                    $hoa_don['trang_thai_don_hang'] = 1;

                    foreach ($array_san_pham as $chi_tiet_hd) {
                        $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                        $soluong__[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);
                    }
                    foreach ($soluong__ as $values2) {
                        if ($values2['so_luong'] > 0) {


                            (new Md_Gio_Hang())->insert_hoa_don($hoa_don);
                            $find_hd = (new Md_Gio_Hang())->hd();

                            foreach ($array_san_pham as $chi_tiet_hd) {
                                $dh_ct['id_hoa_don'] = $find_hd['id'];
                                $dh_ct['so_luong_mua'] = $chi_tiet_hd['so_luong_mua'];
                                $dh_ct['don_gia'] = $chi_tiet_hd['gia_ban'];
                                $dh_ct['thanh_tien'] = $chi_tiet_hd['gia_ban'] * $chi_tiet_hd['so_luong_mua'];
                                $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                                (new Md_Gio_Hang())->insert_hoa_don_ct($dh_ct);

                                $update_soluong[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);

                                $so_luong_c[] = $dh_ct['so_luong_mua'];
                            }


                            foreach ($array_san_pham as $delete) {
                                (new Md_Gio_Hang())->delete($delete['id_chi_tiet_san_pham'], $_SESSION['id_khach_hang']);
                                foreach ($update_soluong as $key => $update) {
                                    if ($delete['id_chi_tiet_san_pham'] == $update['id']) {
                                        foreach ($so_luong_c as $key1 => $v2) {
                                            if ($key == $key1) {
                                                $sl_moi = $update['so_luong'] -  $v2;
                                                (new Md_san_pham())->update_sl_sp($delete['id_chi_tiet_san_pham'], $sl_moi);
                                            }
                                        }
                                    }
                                }
                            }



                            $keep_sessions = ['id_khach_hang', 'name_khach_hang', 'avt', 'vai_tro'];


                            hienThiThongBao();
                            gui_email_phpmailer($_SESSION['momo']['email_nguoi_nhan'], "Đặt hàng thành công", "<h1>Sản phẩm sẽ sớm được giao đến bạn</h1>");
                            foreach ($_SESSION as $key => $value) {
                                if (!in_array($key, $keep_sessions)) {
                                    unset($_SESSION[$key]); // Xóa các session không cần thiết
                                }
                            }
                        }
                    }
                } elseif (isset($_POST['payUrl']) && $_POST['payUrl'] == 'MOMO') {
                    if (isset($_POST['ten_nguoi_nhan'])) {
                        $_SESSION['momo'] = $_POST;
                        $_SESSION['momo']['trang_thai_thanh_toan'] = 'Đã thanh toán';
                    }

                    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
                    $partnercode = 'MOMOBKUN20180529';
                    $accesskey = 'klm05TvNBzhg7h7j';
                    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

                    $orderinfo = "Thanh toán qua MoMo";
                    $amounT = $_SESSION['momo']['thanh_toan'];
                    $orderid = rand(10000, 99999);
                    $redirecturl = "http://localhost:3000/index.php?act=thanh_toan";
                    $ipnurl = "http://localhost:3000/index.php?act=thanh_toan";
                    $extradata = "";

                    if (!empty($_POST)) {
                        $partnerCode = $partnercode;
                        $accessKey = $accesskey;
                        $serectkey = $secretKey;
                        $orderId = $orderid;
                        $orderInfo = $orderinfo;
                        $amount = $amounT;
                        $ipnUrl = $ipnurl;
                        $redirectUrl = $redirecturl;
                        $extraData = isset($_POST["extraData"]) ? $_POST["extraData"] : ""; // Sửa lỗi Undefined

                        $requestId = time() . "";
                        $requestType = "payWithATM";

                        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                        $signature = hash_hmac("sha256", $rawHash, $serectkey);

                        $data = array(
                            'partnerCode' => $partnerCode,
                            'partnerName' => "Test",
                            "storeId" => "MomoTestStore",
                            'requestId' => $requestId,
                            'amount' => $amount,
                            'orderId' => $orderId,
                            'orderInfo' => $orderInfo,
                            'redirectUrl' => $redirectUrl,
                            'ipnUrl' => $ipnUrl,
                            'lang' => 'vi',
                            'extraData' => $extraData,
                            'requestType' => $requestType,
                            'signature' => $signature
                        );

                        $result = (new Gio_Hang)->execPostRequest($endpoint, json_encode($data));
                        $jsonResult = json_decode($result, true);  // decode JSON

                        if (isset($jsonResult['payUrl'])) {
                            header('Location: ' . $jsonResult['payUrl']);
                        }
                    }




                    if (empty($extraData)) {
                        $errorMessage = "Lỗi: Không thể thực hiện thanh toán. Vui lòng thử lại.";
                        echo "<div class='alert alert-danger'>$errorMessage</div>";
                    }
                }
            }

            if (isset($_GET['resultCode']) && $_GET['resultCode'] == 0) {

                $hoa_don = $_SESSION['momo'];
                $_SESSION['thanh_tien'] = $hoa_don['thanh_toan'];
                $so_luong_c = [];

                $hoa_don['ma_don_hang'] = $_GET['orderId'];
                $hoa_don['id_khach_hang'] = $_SESSION['id_khach_hang'];
                $hoa_don['trang_thai_don_hang'] = 1;

                foreach ($array_san_pham as $chi_tiet_hd) {
                    $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                    $soluong__[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);
                }
                foreach ($soluong__ as $values2) {
                    if ($values2['so_luong'] > 0) {


                        (new Md_Gio_Hang())->insert_hoa_don($hoa_don);
                        $find_hd = (new Md_Gio_Hang())->hd();

                        foreach ($array_san_pham as $chi_tiet_hd) {
                            $dh_ct['id_hoa_don'] = $find_hd['id'];
                            $dh_ct['so_luong_mua'] = $chi_tiet_hd['so_luong_mua'];
                            $dh_ct['don_gia'] = $chi_tiet_hd['gia_ban'];
                            $dh_ct['thanh_tien'] = $chi_tiet_hd['gia_ban'] * $chi_tiet_hd['so_luong_mua'];
                            $dh_ct['id_chi_tiet_san_pham'] = $chi_tiet_hd['id_chi_tiet_san_pham'];
                            (new Md_Gio_Hang())->insert_hoa_don_ct($dh_ct);

                            $update_soluong[] = (new Md_san_pham)->find_onespct($dh_ct['id_chi_tiet_san_pham']);

                            $so_luong_c[] = $dh_ct['so_luong_mua'];
                        }


                        foreach ($array_san_pham as $delete) {
                            (new Md_Gio_Hang())->delete($delete['id_chi_tiet_san_pham'], $_SESSION['id_khach_hang']);
                            foreach ($update_soluong as $key => $update) {
                                if ($delete['id_chi_tiet_san_pham'] == $update['id']) {
                                    foreach ($so_luong_c as $key1 => $v2) {
                                        if ($key == $key1) {
                                            $sl_moi = $update['so_luong'] -  $v2;
                                            (new Md_san_pham())->update_sl_sp($delete['id_chi_tiet_san_pham'], $sl_moi);
                                        }
                                    }
                                }
                            }
                        }



                        $keep_sessions = ['id_khach_hang', 'name_khach_hang', 'avt', 'vai_tro'];



                        hienThiThongBao();
                        gui_email_phpmailer($_SESSION['momo']['email_nguoi_nhan'], "Đặt hàng thành công", "<h1>Sản phẩm sẽ sớm được giao đến bạn</h1>");
                        foreach ($_SESSION as $key => $value) {
                            if (!in_array($key, $keep_sessions)) {
                                unset($_SESSION[$key]); // Xóa các session không cần thiết
                            }
                        }
                    }
                }
            }

            view('ThanhToan', ['array_san_pham' => $array_san_pham, 'voucher' => $voucher, 'data_nhan_hang' => $data_nhan_hang]);
        }
    }

    public function don_hang()
    {
        if (isset($_SESSION['id_khach_hang'])) {
            $data = (new Md_Gio_Hang())->don_hang__all($_SESSION['id_khach_hang']);
            view('Donhang', ['data' => $data]);
        }
    }
    public function don_hang_chi_tiet()
    {
        $id = $_GET['id'];
        $danh_gias_one = (new Md_Gio_Hang())->danh_gias_one();
        $oder = (new Md_Gio_Hang())->don_hang__($id);
        $data = (new Md_Gio_Hang)->hoa_don_chi_tiet($id);
        view('hoa_don_chi_tiet', ['data' => $data, 'oder' => $oder, 'danh_gias_one' => $danh_gias_one]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trang_thai']) && $_POST['trang_thai'] == 03) {
            (new Md_Gio_Hang())->update_HD($_POST['trang_thai_don_hang'], $_POST['id_hoa_don'], $_POST['trang_thai_thanh_toan']);

            foreach ($data as $index => $items) {
                $data_san_pham_HUY = (new Md_san_pham)->find_CTSP($items['id_chi_tiet_san_pham']);


                $sl_HUY = $items['so_luong_mua'] + $data_san_pham_HUY['so_luong'];
                (new Md_san_pham())->update_SL_SPCT($data_san_pham_HUY['id'], $sl_HUY);
            }


            echo "<script type='text/javascript'>
                        window.location.href = 'index.php?act=don_hang';
                    </script>";
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['trang_thai']) && $_POST['trang_thai'] == 04) {
            (new Md_Gio_Hang())->update_HD($_POST['trang_thai_don_hang'], $_POST['id_hoa_don'], $_POST['trang_thai_thanh_toan']);
            echo "<script type='text/javascript'>
                        window.location.href = 'index.php?act=don_hang';
                    </script>";
        }
    }

    public function yeu_thich()
    {

        $data = (new Md_Gio_Hang())->find_all_yeu_thich($_SESSION['id_khach_hang']);
        view(
            'YeuThich',
            [
                'data' => $data
            ]
        );
    }

    public function delete_yeu_thich()
    {
        $id = $_GET['id'];
        (new Md_Gio_Hang())->delete_YT($id, $_SESSION['id_khach_hang']);
        echo "<script type='text/javascript'>
                        window.location.href = 'index.php?act=yeu_thich';
                    </script>";
    }
}
