<?php

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';

// Route
$act = $_GET['act'] ?? '/';



// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Danh mục sản phẩm
    'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
    'form-them-danh-muc' => (new AdminDanhMucController())->formThemDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucController())->themDanhMuc(),
    'form-sua-danh-muc' => (new AdminDanhMucController())->formEditThemDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucController())->editDanhMuc(),
    'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),

    // Sản phẩm
    'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
    'chi-tiet-san-pham' => (new AdminSanPhamController())->chiTietSanPham(),
    'form-them-san-pham' => (new AdminSanPhamController())->formThemSanPham(),
    'them-san-pham' => (new AdminSanPhamController())->themSanPham(),
    'form-sua-san-pham' => (new AdminSanPhamController())->formEditThemSanPham(),
    'sua-san-pham' => (new AdminSanPhamController())->suaSanPham(),
    'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),

    // Đơn hàng
    'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
    'chi-tiet-don-hang' => (new AdminDonHangController())->chiTietDonHang(),
    'form-sua-don-hang' => (new AdminDonHangController())->formEditThemDonHang(),
    'sua-don-hang' => (new AdminDonHangController())->suaDonHang(),
    'xoa-don-hang' => (new AdminDonHangController())->deleteDonHang(),
};
