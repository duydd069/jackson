<?php
class AdminDanhMucController
{
    public $modelDanhMuc;
    public function __construct()
    {
        // Khởi tạo model
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachDanhMuc()
    {

        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }
    public function formThemDanhMuc()
    {
        require_once './views/danhmuc/formThemDanhMuc.php';
    }
    public function themDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

            // Validate input
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống.';
            }

            if (empty($errors)) {
                $this->modelDanhMuc->addDanhMuc($ten_danh_muc, $mo_ta);
                // Redirect to danh sách danh mục
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                require_once './views/danhmuc/formThemDanhMuc.php';
            }
        }
    }
    public function formEditThemDanhMuc()
    {
        $id = $_GET['id'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        // var_dump($danhMuc);
        // die();
        if ($danhMuc) {
            require_once './views/danhmuc/formEditDanhMuc.php';
        } else {
            // Nếu danh mục không tồn tại, chuyển hướng về danh sách danh mục
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
    public function editDanhMuc()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // Validate input
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống.';
            }

            if (empty($errors)) {
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                // Redirect to danh sách danh mục
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                require_once './views/danhmuc/formThemDanhMuc.php';
            }
        }
    }
    public function deleteDanhMuc()
    {
        $id = $_GET['id'];
        $danhMuc= $this->modelDanhMuc->getDetailDanhMuc($id);

        if ($danhMuc) {
            $this->modelDanhMuc->destroyDanhMuc($id);
            // Redirect to danh sách danh mục
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }
}
