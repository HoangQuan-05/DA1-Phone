<?php

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';

// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';


switch ($act) {
    case 'dashboard':
      ( new DashboardController() )->index();
        break;

    case 'lienhe':
        (new DashboardController())->lien_he();
        break;
};
