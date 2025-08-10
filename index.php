<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/AuthController.php';
require_once './controllers/GioHangController.php';
require_once './controllers/ThanhToanController.php';

// Require toàn bộ file Models
require_once './models/AdminTaiKhoan.php';
require_once './models/Home.php';
require_once './models/GioHangModel.php';
require_once './models/ThanhToan.php';


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
    'san-pham' => (new HomeController())->danhSachSanPham(), // Danh sách sản phẩm
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(), // Chi tiết sản phẩm

    //Login
    'form-login' => (new AdminAuthController())->formLogin(),
    'dang-ky' => (new AdminAuthController())->formRegister(),
    'register' => (new AdminAuthController())->register(),
    'login' => (new AdminAuthController())->login(),
    'logout' => (new AdminAuthController())->logout(),

    // Giỏ hàng
    'gio-hang' => (new GioHangController())->hienThiGioHang(),
    'them-vao-gio-hang' => (new GioHangController())->themVaoGioHang(),
    'cap-nhat-so-luong' => (new GioHangController())->capNhatSoLuong(),
    'xoa-san-pham-gio' => (new GioHangController())->xoaSanPham(),

    // Thanh toán
    'xac-nhan-thong-tin' => (new ThanhToanController())->thanhToan(),
    'dat-hang'            => (new ThanhToanController())->datHang(),     // submit POST để lưu đơn
    'xem-don-hang'        => (new ThanhToanController())->xemDonHang(),
};
