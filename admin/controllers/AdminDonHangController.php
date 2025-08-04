<?php
class AdminDonHangController
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }
    public function danhSachDonHang()
    {

        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }



    public function chiTietDonHang()
    {
        $id = $_GET['id'];
        $donHang = $this->modelDonHang->getDonHangById($id);
        if (!$donHang) {
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
        require_once './views/donHang/detailDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id'];
        $donHang = $this->modelDonHang->getDonHangById($don_hang_id);
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        require_once './views/donhang/chiTietDonHang.php';
    }

    public function formEditThemDonHang()
    {
        $id = $_GET['id'];
        $donHang = $this->modelDonHang->getDonHangById($id);
        if (!$donHang) {
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
        $phuongThucThanhToanList = $this->modelDonHang->getAllPhuongThucThanhToan();
        $trangThaiDonHangList = $this->modelDonHang->getAllTrangThaiDonHang();
        require_once './views/donhang/formEditDonHang.php';
    }

    public function suaDonHang() {
    $id = $_POST['id'];
    $donHang = $this->modelDonHang->getDonHangById($id);

    $tong_tien = $donHang['tong_tien'];
    if ($donHang['trang_thai_id'] != 1) {
        $phuong_thuc_thanh_toan_id = $donHang['phuong_thuc_thanh_toan_id'];
    } else {
        $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
    }

    $trang_thai_id = $_POST['trang_thai_id'];
    if ($trang_thai_id < $donHang['trang_thai_id']) {
        $trang_thai_id = $donHang['trang_thai_id'];
    }
    $this->modelDonHang->updateDonHang(
        $id,
        $_POST['ten_nguoi_nhan'],
        $_POST['email_nguoi_nhan'],
        $_POST['sdt_nguoi_nhan'],
        $_POST['dia_chi_nguoi_nhan'],
        $tong_tien,
        $_POST['ghi_chu'],
        $phuong_thuc_thanh_toan_id,
        $trang_thai_id
    );

    header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
}


    

    public function deleteDonHang()
    {
        $id = $_GET['id'];
        if ($id) {
            $this->modelDonHang->deleteDonHang($id);
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
    }


}
