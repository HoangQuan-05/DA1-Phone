<?php

class DashboardController
{
    public function index()
    {
        require_once "./views/dashboard.php";
    }
    public function lien_he()
    {
        $data =  (new lien_he())->tin_nhan_khach_hang(4);
        view('lienhe',['du_lieu'=>$data]);
    }
    public function ho_tro_khach_hang()
    { 
        $data =  (new lien_he())->hien_thi_tin_nhan(3,4);
        
        
        view('hotrokhachhang',['du_lieu'=>$data]);
        
       
    }
}
