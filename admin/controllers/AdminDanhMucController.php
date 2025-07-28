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
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }

    $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
    if (!$danhMuc) {
        header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }

    // Kiểm tra xem có sản phẩm nào thuộc danh mục này không
    $soSanPham = $this->modelDanhMuc->countSanPhamByDanhMuc($id);

    if ($soSanPham > 0 && !isset($_GET['force'])) {
        // Hiển thị thông báo xác nhận xóa
        echo "
            <script>
                if (confirm('Danh mục vẫn còn {$soSanPham} sản phẩm. Bạn có chắc muốn xóa và chuyển các sản phẩm sang “Không có danh mục”?')) {
                    window.location.href = '" . BASE_URL_ADMIN . "?act=xoa-danh-muc&id={$id}&force=1';
                } else {
                    window.location.href = '" . BASE_URL_ADMIN . "?act=danh-muc';
                }
            </script>
        ";
        exit();
    }

    // Nếu force = 1 thì cập nhật sản phẩm về danh_muc_id = 0
    if ($soSanPham > 0) {
        $this->modelDanhMuc->chuyenSanPhamVeKhongDanhMuc($id);
    }

    // Xóa danh mục
    $this->modelDanhMuc->destroyDanhMuc($id);

    header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
    exit();
}


}
