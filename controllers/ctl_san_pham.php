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
            $offset = 0;
        }
        $san_pham = (new Md_san_pham())->show_all_san_pham($offset);

        if (isset($_GET['by'])) {
            $min_max = (new Md_san_pham())->show_san_pham_min($_GET['by'], $offset);
        }else{
            $min_max = [];
        }

        if(isset($_GET['danh_muc'])){
            $sp_danh_muc = (new Md_san_pham())->show_san_pham_danh_muc($_GET['danh_muc'],$offset);
        }else{
            $sp_danh_muc = [];
        }


        $danh_muc = (new Md_danh_muc())->all();
        view('SanPham/SanPham', ['san_pham' => $san_pham, 'danh_muc' => $danh_muc, 'count' => $count,'min_max'=>$min_max,'sp_danh_muc'=>$sp_danh_muc]);
        echo $count['COUNT(id_san_pham)'];
    }
}