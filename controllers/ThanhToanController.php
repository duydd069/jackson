<?php
class ThanhToanController
{
    public $thanhToanModel;
    public $gioHangModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $this->gioHangModel   = new GioHangModel();
        $this->thanhToanModel = new ThanhToanModel();
    }

    // Trang form tổng thanh toán
    public function thanhToan()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?act=form-login"); exit;
        }
        $uid        = (int)$_SESSION['user']['id'];
        $khachHang  = $this->gioHangModel->getThongTinKhachHang($uid);
        $cartItems  = $this->gioHangModel->getCartItemsByUserId($uid);

        $subTotal = 0.0;
        foreach ($cartItems as $it) $subTotal += (float)$it['thanh_tien'];
        $shipping   = $this->thanhToanModel->tinhPhiVanChuyen($subTotal);
        $grandTotal = $subTotal + $shipping;

        $paymentMethods = $this->thanhToanModel->getPhuongThucThanhToan();

        require './views/thanhToan.php';
    }

    // Submit thanh toán -> lưu DB -> chuyển trang chi tiết
    public function datHang()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?act=form-login"); exit;
        }
        $uid       = (int)$_SESSION['user']['id'];
        $cartItems = $this->gioHangModel->getCartItemsByUserId($uid);

        if (empty($cartItems)) {
            // không có hàng => quay lại giỏ
            header("Location: " . BASE_URL . "?act=cart"); exit;
        }

        // Lấy dữ liệu từ form tổng
        $ten   = trim($_POST['ten_nguoi_nhan'] ?? '');
        $email = trim($_POST['email_nguoi_nhan'] ?? '');
        $sdt   = trim($_POST['sdt_nguoi_nhan'] ?? '');
        $diachi= trim($_POST['dia_chi_nguoi_nhan'] ?? '');
        $ghichu= trim($_POST['ghi_chu'] ?? '');
        $pttt  = (int)($_POST['paymentmethod'] ?? 1);

        // Tính lại tổng từ server
        $subTotal = 0.0;
        foreach ($cartItems as $it) $subTotal += (float)$it['thanh_tien'];
        $shipping   = $this->thanhToanModel->tinhPhiVanChuyen($subTotal);
        $grandTotal = $subTotal + $shipping;

        // Lưu đơn
        $donHangId = $this->thanhToanModel->taoDonHang([
            'tai_khoan_id'               => $uid,
            'ten_nguoi_nhan'             => $ten,
            'email_nguoi_nhan'           => $email,
            'sdt_nguoi_nhan'             => $sdt,
            'dia_chi_nguoi_nhan'         => $diachi,
            'ghi_chu'                    => $ghichu,
            'phuong_thuc_thanh_toan_id'  => $pttt,
            'grand_total'                => $grandTotal,
        ], $cartItems);

        // Xoá giỏ
        $this->gioHangModel->clearCartByUser($uid);

        // Chuyển tới trang chi tiết đơn
        header("Location: " . BASE_URL . "?act=xem-don-hang&id=" . $donHangId);
        exit;
    }

    // Trang xem chi tiết đơn
    public function xemDonHang()
    {
        if (!isset($_GET['id'])) { header("Location: " . BASE_URL); exit; }
        $id = (int)$_GET['id'];

        $don = $this->thanhToanModel->getDonHangById($id);
        if (!$don) { header("Location: " . BASE_URL); exit; }

        $items = $this->thanhToanModel->getChiTietDonHang($id);

        // Ngày giao dự kiến = ngày đặt + 5 ngày (cố định)
        $ngayDat = new DateTime($don['ngay_dat']);
        $ngayGiaoDuKien = clone $ngayDat;
        $ngayGiaoDuKien->modify('+5 days');

        require './views/donHangChiTiet.php';
    }

    // (option) anh giữ hàm này nếu muốn tái sử dụng
    public function layThongTinKhachHang(){
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?act=form-login"); exit;
        }
        $taiKhoanId = (int)$_SESSION['user']['id'];
        return $this->gioHangModel->getThongTinKhachHang($taiKhoanId);
    }
}
