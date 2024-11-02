<?php

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ
require_once 'models/md_lien_he.php';
require_once 'models/banners.php';
require_once "models/md_danh_muc.php";
require_once 'controllers/danhmuc_ctl.php';

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/bannercontroller.php';

// Require toàn bộ file Models

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
};


