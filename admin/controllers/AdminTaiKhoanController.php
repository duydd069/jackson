<?php
class AdminTaiKhoanController
{
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }

    // Danh sách admin
    public function danhSachAdmin()
    {
        $admins = $this->modelTaiKhoan->getAllAdmin();
        require_once './views/taikhoan/listAdmin.php';
    }

    // Danh sách người dùng
    public function danhSachUser()
    {
        $users = $this->modelTaiKhoan->getAllUser();
        require_once './views/taikhoan/listUser.php';
    }

    // Xử lý chuyển quyền admin về user
    public function xoaQuyenAdmin()
    {
        $id = $_GET['id'] ?? null;
        if ($_SESSION['admin']['id'] != 1 || $id == 1) {
            $_SESSION['error'] = "Bạn không có quyền thực hiện thao tác này!";
        } else {
            $this->modelTaiKhoan->chuyenAdminVeUser($id);
        }
        header('Location: ' . BASE_URL_ADMIN . '?act=quan-ly-admin');
        exit;
    }

    // Xử lý ban/mở ban user
    public function toggleBanUser()
    {
        $id = $_GET['id'] ?? null;
        $this->modelTaiKhoan->toggleTrangThaiUser($id);
        header('Location: ' . BASE_URL_ADMIN . '?act=quan-ly-user');
        exit;
    }
    public function logout()
    {
        // Xóa tất cả session
        unset($_SESSION['admin']);
        unset($_SESSION['user']);
        unset($_SESSION['user_role']);
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }
}
