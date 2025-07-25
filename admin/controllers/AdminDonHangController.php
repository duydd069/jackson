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
        $id = $_GET['id'] ?? 0;
        $donHang = $this->modelDonHang->getDonHangById($id);
        if (!$donHang) {
            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
        require_once './views/donHang/detailDonHang.php';
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

    public function suaDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $tong_tien = $_POST['tong_tien'];
            $ghi_chu = $_POST['ghi_chu'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $trang_thai_id = $_POST['trang_thai_id'];

            $this->modelDonHang->updateDonHang(
                $id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $tong_tien,
                $ghi_chu,
                $phuong_thuc_thanh_toan_id,
                $trang_thai_id
            );

            header('Location: ' . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
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
