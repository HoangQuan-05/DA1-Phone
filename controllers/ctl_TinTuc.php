<?php

class TinTuc
{
    public function tin_tuc()
    {
        $danh_muc = (new Md_danh_muc())->all();
        view("TinTuc/HienThi", ['danh_muc' => $danh_muc]);
    }
    public function chi_tiettin_tuc()
    {
        $danh_muc = (new Md_danh_muc())->all();
        view("TinTuc/ChiTiet", ['danh_muc' => $danh_muc]);
    }
}
