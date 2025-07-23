<?php
class AdminSanPhamController
{
    public $modelSanPham;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham()
    {
        
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/sanpham/listSanPham.php';
    }
    public function formThemSanPham()
    {
        $danhMucList = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/formThemSanPham.php';
    }

    public function themSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'];

            $file_thumb = uploadFile($hinh_anh, './uploads/sanpham/');

            // $img_array = $_FILES['img_array'];

            // Validate input
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống.';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống.';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống.';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống.';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn.';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn.';
            }

            if (empty($errors)) {

                $this->modelSanPham->addSanPham($ten_san_pham, 
                                                $gia_san_pham, 
                                                $gia_khuyen_mai, 
                                                $so_luong, 
                                                $ngay_nhap, 
                                                $danh_muc_id, 
                                                $trang_thai, 
                                                $mo_ta,
                                                $file_thumb);

                // Redirect to danh sách danh mục
                header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                require_once './views/sanpham/formThemSanPham.php';
            }
        }
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id'] ?? 0;
        $sanPham = $this->modelSanPham->getSanPhamById($id);
        if (!$sanPham) {
            header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
        require_once './views/sanpham/detailSanPham.php';
    }

    public function formEditThemSanPham()
    {
        $id = $_GET['id'];
        $sanPham = $this->modelSanPham->getSanPhamById($id);
        if (!$sanPham) {
            header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
        $danhMucList = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/sanpham/formEditSanPham.php';
    }

    public function suaSanPham()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'] ?? '';

            $hinh_anh = $_FILES['hinh_anh'];

            // Validate input
            $errors = [];
            if (empty($ten_san_pham)) {
                $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống.';
            }
            if (empty($gia_san_pham)) {
                $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống.';
            }
            if (empty($so_luong)) {
                $errors['so_luong'] = 'Số lượng sản phẩm không được để trống.';
            }
            if (empty($ngay_nhap)) {
                $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống.';
            }
            if (empty($danh_muc_id)) {
                $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn.';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn.';
            }

            if (empty($errors)) {

                // Upload file
                if ($hinh_anh && $hinh_anh['error'] == 0) {
                    $file_thumb = uploadFile($hinh_anh, './uploads/sanpham/');
                } else {
                    // If no new image, keep the old one
                    $file_thumb = $_POST['old_hinh_anh'];
                }

                // Update product
                $this->modelSanPham->updateSanPham($id, 
                                                    $ten_san_pham, 
                                                    $gia_san_pham, 
                                                    $gia_khuyen_mai, 
                                                    $so_luong, 
                                                    $ngay_nhap, 
                                                    $danh_muc_id, 
                                                    $trang_thai, 
                                                    $mo_ta,
                                                    $file_thumb);

                // Redirect to danh sách danh mục
                header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
                exit();
            } else {
                require_once './views/sanpham/formEditSanPham.php';
            }
        }
    }

    public function deleteSanPham()
    {
        $id = $_GET['id'];
        if ($id) {
            $this->modelSanPham->deleteSanPham($id);
            header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=san-pham');
            exit();
        }
    }


}