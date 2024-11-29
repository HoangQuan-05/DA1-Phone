<?php

class Don_hang
{

    public function all_don_hang()
    {
        $data_hoa_don = (new Md_Hoa_Don())->all_hoa_don();

        view('quan_ly_don_hang/hien_thi', ['data_hoa_don' => $data_hoa_don]);
    }
    public function don_hang_chi_tiet()
    {
        $tr_thai = (new Md_Hoa_Don())->trang_thai_dh();
        $id = $_GET['id'];
        $data_tt = (new Md_Hoa_Don())->find_tt($id);
        $hoa_don = (new Md_Hoa_Don())->find_hoa_don($id);
        $voucher = (new khuyenmais)->all();
        $chi_tiet_hoa_don = (new Md_Hoa_Don())->hoa_don_chi_tiet($id);


        view('quan_ly_don_hang/chi_tiet', ['chi_tiet_hoa_don' => $chi_tiet_hoa_don, 'tr_thai' => $tr_thai, 'data_tt' => $data_tt, 'hoa_don' => $hoa_don,'voucher'=>$voucher]);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tt = $_POST['trang_thai'];
            if($tt ==5 ){
                $tt_thanh_toan = 'Đã thanh toán';
            }
            else{
                $tt_thanh_toan = 'Chưa thanh toán';
            }
            (new Md_Hoa_Don())->update_tt($id,$tt_thanh_toan, $tt);
            echo "<script type='text/javascript'>
                    window.location.href = 'index.php?act=don_hang';
                </script>";
        }
    }

    public function delete_don_hang()
    {
        $id = $_GET['id_hoa_don'];
        (new Md_Hoa_Don())->delete_don_hang($id);
        header("location: index.php?act=don_hang");
    }
}
