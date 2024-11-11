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
        $chi_tiet_hoa_don = (new Md_Hoa_Don())->find_hoa_don($id);
        view('quan_ly_don_hang/chi_tiet', ['chi_tiet_hoa_don' => $chi_tiet_hoa_don, 'tr_thai' => $tr_thai, 'data_tt' => $data_tt]);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tt = $_POST['trang_thai'];
            (new Md_Hoa_Don())->update_tt($id, $tt);
            echo "<script type='text/javascript'>
                        window.location.href = 'index.php?act=don_hang';
                    </script>";
        }
    }
}
