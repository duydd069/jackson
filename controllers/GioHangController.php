<?php
class GioHangController
{
    public $gioHangModel;
    public $modelHome;

    public function __construct()
    {
        $this->gioHangModel = new GioHangModel();
        $this->modelHome = new Home();
    }

    public function hienThiGioHang()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?act=form-login");
            exit;
        }
        $listCategory = $this->modelHome->getAllCategories();
        $listPhuongThucThanhToan = $this->gioHangModel->getAllPhuongThucThanhToan();

        $taiKhoanId = $_SESSION['user']['id'];
        $gioHang = $this->gioHangModel->getGioHangByTaiKhoanId($taiKhoanId);

        $dsSanPhamTrongGio = [];
        $tongTien = 0;
        $gioHangId = null;

        if ($gioHang) {
            $gioHangId = $gioHang['id'];
            $chiTiet = $this->gioHangModel->getChiTietGioHang($gioHangId);

            foreach ($chiTiet as $item) {
                $sanPham = $this->modelHome->getSanPhamById($item['san_pham_id']);
                if ($sanPham) {
                    $soLuong = $item['so_luong'];
                    $donGia = $sanPham['gia_khuyen_mai'] ?? $sanPham['gia_san_pham'];
                    $thanhTien = $donGia * $soLuong;

                    $dsSanPhamTrongGio[] = [
                        'hinh_anh' => $sanPham['hinh_anh'],
                        'ten_san_pham' => $sanPham['ten_san_pham'],
                        'gia' => $donGia,
                        'so_luong' => $soLuong,
                        'tong' => $thanhTien,
                        'id' => $sanPham['id'],
                        'ton_kho' => $sanPham['so_luong'],
                    ];


                    $tongTien += $thanhTien;
                }
            }
        }

        require_once './views/GioHang.php';
    }


    public function themVaoGioHang()
{
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "?act=form-login");
        exit;
    }

    // LẤY ID TỪ POST thay vì GET
    $sanPhamId  = $_POST['id'] ?? $_GET['id'] ?? null;
    $soLuong    = isset($_POST['so_luong']) ? (int)$_POST['so_luong'] : 1;
    $taiKhoanId = (int)$_SESSION['user']['id'];

    if ($sanPhamId) {
        $gioHang = $this->gioHangModel->getOrCreateGioHang($taiKhoanId);
        $this->gioHangModel->themSanPham((int)$gioHang['id'], (int)$sanPhamId, (int)$soLuong);
    }

    // Thêm thông báo thành công
    $_SESSION['cart_success'] = 'Đã thêm sản phẩm vào giỏ hàng!';
    
    header("Location: " . BASE_URL . "?act=gio-hang");
    exit;
}


    public function capNhatSoLuong()
    {

        $gioHangId = $_POST['gio_hang_id'];
        $sanPhamId = $_POST['san_pham_id'];
        $soLuongMoi = $_POST['so_luong'];
        $sanPham = $this->modelHome->getSanPhamById($sanPhamId);
        if ($soLuongMoi > $sanPham['so_luong']) {
            $_SESSION['cart_error_id'] = $sanPham['id'];
            $_SESSION['cart_error_msg'] = "Chỉ còn {$sanPham['so_luong']} sản phẩm \"{$sanPham['ten_san_pham']}\" trong kho!";
            header('Location: ' . BASE_URL . '?act=gio-hang');
            exit;
        }


        $this->gioHangModel->capNhatSoLuong($gioHangId, $sanPhamId, $soLuongMoi);
        header("Location: " . BASE_URL . "?act=gio-hang");
        exit;
    }

    public function xoaSanPham()
    {
        $sanPhamId = $_GET['id'];
        $taiKhoanId = $_SESSION['user']['id'];
        $gioHang = $this->gioHangModel->getGioHangByTaiKhoanId($taiKhoanId);

        $this->gioHangModel->xoaSanPhamTrongGio($gioHang['id'], $sanPhamId);
        header("Location: " . BASE_URL . "?act=gio-hang");
        exit;
    }

    

}
