<?php

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once "controllers/ctl_san_pham.php";
require_once "admin/controllers/ctl_login.php";
require_once "controllers/ctl_TinTuc.php";
require_once "controllers/TaiKhoan.php";
require_once "controllers/CTL_KhuyenMai.php";
require_once "controllers/CTL_LienHe.php";

// Require toàn bộ file Models
require_once "models/md_sanpham.php";
require_once "models/md_danh_muc.php";
require_once "models/md_sanpham.php";
require_once "admin/models/md_khach_hang.php";
require_once "models/Md_LienHe.php";
// Route
$act = $_GET['act'] ?? '/';
session_start();

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match


switch ($act) {
    case 'trang_chu':
    case '/':
        (new HomeController())->index();
        break;
    case 'san_pham':
        (new SanPham())->san_pham();
        break;
    case 'chi_tiet_san_pham':
        (new SanPham())->chi_tiet_san_pham();
        break;
    case 'logout':
        (new loginController())->log_out();
        break;
    case 'login':
        (new loginController())->login();
        break;
    case 'register':
        (new loginController())->register();
        break;
    case 'tin_tuc':
        (new TinTuc())->tin_tuc();
        break;
    case 'chi_tiet_tin_tuc':
        (new TinTuc())->chi_tiettin_tuc();
        break;
    case 'thong_tin_ca_nhan':
        (new TaiKhoan())->thong_tin_ca_nhan();
        break;
    case 'khuyen_mai':
        (new KhuyenMai())->khuyen_mai();
        break;
    case 'lien_he':
        (new LienHe())->lien_he();
        break;
}
