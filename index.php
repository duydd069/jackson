<?php 

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/AuthController.php';

// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/Sanpham.php';


// Route
$act = $_GET['act'] ?? '/';
// if ($_GET['act']){
//     $act = $_GET['act'];
// } else {
//     $act = '/'; 
// }


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(), // Trang chủ
    'trangchu' => (new HomeController())->trangchu(), // Trang chủ
    'danhsachsanpham' => (new HomeController())->danhSachSanPham(), // Danh sách sản phẩm

    //Login
    'form-login' => (new AdminAuthController())->formLogin(), // Form đăng nhập
    'login' => (new AdminAuthController())->login(), // Xử lý đăng nhập
    'logout' => (new AdminAuthController())->logout(), // Xử lý đăng xuất
    
};