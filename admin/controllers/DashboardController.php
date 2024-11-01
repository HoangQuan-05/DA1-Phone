<?php

class DashboardController {
    public function index() {
        require_once "./views/dashboard.php";
    }
    public function lien_he(){
        require_once "./views/lienhe.php";
    }
    public function ho_tro_khach_hang(){
        require_once "./views/hotrokhachhang.php";
    }
}