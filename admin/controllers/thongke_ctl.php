<?php

class ThongkeController
{
    private $model;

    public function __construct()
    {
        $this->model = new Thongkes();
    }
    public function showStatistics()
    {
        $statistics = $this->model->all();
        $tong_sp = (new Thongkes())->thong_ke_so_luong_san_pham();
        $doanh_thu = (new Thongkes())->thong_ke_doanh_thu();

        if ($statistics) {
         
            $hoa_sons = $statistics['tong_hoa_dons'];
            
            require 'views/thongke.php';
        } else {
            echo "Không thể lấy thông tin thống kê.";
        }
    }
}
?>

