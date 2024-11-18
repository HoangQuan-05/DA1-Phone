<?php

class HomeController
{
    public function index()
    {
        $san_pham = (new Md_san_pham())->show_san_pham();
        $banner = (new Md_danh_muc())->banner();
        $danh_muc = (new Md_danh_muc())->all();
        view('home', ['san_pham' => $san_pham, 'danh_muc' => $danh_muc,'banner'=>$banner]);
    }
}
