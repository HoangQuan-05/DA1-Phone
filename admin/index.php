<?php

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ


// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/bannercontroller.php';
require_once 'controllers/danhmuc_ctl.php';
require_once 'controllers/tin_tuc_ctl.php';
require_once 'controllers/ctl_san_pham.php';
require_once  'controllers/khachhang_ctl.php';
require_once "models/khuyenmai.php";

// Require toàn bộ file Models
require_once 'models/md_lien_he.php';
require_once 'models/banners.php';
require_once "models/md_danh_muc.php";
require_once "models/md_tin_tuc.php";
require_once 'models/md_san_pham.php';
require_once "models/md_khach_hang.php";
require_once  'controllers/khuyenmaicontroller.php';


// Route
$act = $_GET['act'] ?? 'dashboard';


switch ($act) {
  case 'dashboard':
    (new DashboardController())->index();
    break;

  case 'lienhe':
    (new DashboardController())->lien_he();
    break;
  case 'ho_tro_khach_hang':
    (new DashboardController())->ho_tro_khach_hang();
    break;
  case 'banner':
    (new bannercontroller())->banner();
    break;
  case 'delete':
    (new bannercontroller())->delete();
    break;
  case 'store':
    (new bannercontroller())->store();
    break;
  case 'them':
    (new bannercontroller())->add();
    break;
  case 'update':
    (new bannercontroller())->update();
    break;
  case 'danhmuc':
    (new Danhmuc_ctl())->danh_muc();
    break;
  case 'add_danhmuc':
    (new Danhmuc_ctl())->add_danh_muc();
    break;
  case 'delete_dm':
    (new Danhmuc_ctl())->delete_dm();
    break;
  case 'update_danh_muc':
    (new Danhmuc_ctl())->update_dm();
    break;
  case 'tin_tuc':
    (new Tin_tuc_ctl())->hien_thi_tin_tuc();
    break;
  case 'delete_tin_tuc':
    (new Tin_tuc_ctl())->delete_tin_tuc();
    break;
  case 'add_tin_tuc':
    (new Tin_tuc_ctl())->add_tin_tuc();
    break;
  case 'edit_tin_tuc':
    (new Tin_tuc_ctl())->edit_tin_tuc();
    break;
  case 'san_pham':
    (new Ctl_san_pham())->show();
    break;
  case 'them_san_pham':
    (new Ctl_san_pham())->them_san_pham();
    break;
  case 'update_san_pham':
    (new Ctl_san_pham())->update_san_pham();
    break;
  case 'delete_san_pham':
    (new Ctl_san_pham())->delete_san_pham();
    break;
  case 'khachhang':
    (new KhachHang_ctl())->khach_hang();
    break;
  case 'update_khachhang':
    (new KhachHang_ctl())->update_khach_hang();
    break;
  case 'dl_khachhang':
    (new KhachHang_ctl())->dl_khach_hang();
    break;
  case 'add_khachhang':
    (new KhachHang_ctl())->add_khach_hang();
    break;
  case 'khuyen_mai':
    (new khuyenmaicontroller())->khuyenmai();
    break;
  case 'deletel':
    (new khuyenmaicontroller())->deletel();
    break;
  case 'voucher':
    (new khuyenmaicontroller())->voucher();
    break;
  case 'add_khuyenmai':
    (new khuyenmaicontroller())->add();
    break;
  case 'updatekm':
    (new khuyenmaicontroller())->updatekm();
    break;
};
