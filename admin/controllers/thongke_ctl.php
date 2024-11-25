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
        $tong_don = (new Thongkes())->all();
        $tong_sp = (new Thongkes())->thong_ke_so_luong_san_pham();
        $dh_da_hoan_thanh = (new Thongkes())->dh_da_hoan_thanh();

        require 'views/dashboard.php';

       
    }
}
