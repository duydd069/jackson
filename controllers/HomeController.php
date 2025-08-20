<?php

class HomeController
{

    public $modelHome;

    public function __construct()
    {
        // Khởi tạo model SanPham
        $this->modelHome = new Home();
    }

    public function home()
    {
        $listProduct = $this->modelHome->getAllProducts();
        $listCategory = $this->modelHome->getAllCategories();
        require_once './views/home.php';
    }

    public function danhSachSanPham()
    {
        $listProduct = $this->modelHome->getAllProducts();
        $listCategory = $this->modelHome->getAllCategories();
        require_once './views/sanPham.php';
    }
    public function danhMucSanPham()
    {
        $listCategory = $this->modelHome->getAllCategories();
        require_once './views/listCategory.php';
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id'] ?? 0;
        $sanPham = $this->modelHome->getSanPhamById($id);
        $listCategory = $this->modelHome->getAllCategories();
        if (!$sanPham) {
            header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham');
            exit();
        }
        require_once './views/chiTietSanPham.php';
    }
    public function thanhToan(){
        require_once './views/thanhToan.php';
    }
    
    public function sanPhamTheoDanhMuc()
    {
        $id = $_GET['id'] ?? 0;
        $listCategory = $this->modelHome->getAllCategories();
        
        // Lấy thông tin danh mục hiện tại
        $danhMucHienTai = null;
        foreach ($listCategory as $category) {
            if ($category['id'] == $id) {
                $danhMucHienTai = $category;
                break;
            }
        }
        
        if (!$danhMucHienTai) {
            header('Location: ' . BASE_URL . '?act=san-pham');
            exit();
        }
        
        // Lấy sản phẩm theo danh mục
        $listProduct = $this->modelHome->getProductsByCategory($id);
        
        require_once './views/sanPhamTheoDanhMuc.php';
    }
    
    public function timKiem()
    {
        $keyword = $_GET['q'] ?? '';
        $listCategory = $this->modelHome->getAllCategories();
        
        if (empty($keyword)) {
            header('Location: ' . BASE_URL . '?act=san-pham');
            exit();
        }
        
        // Lấy sản phẩm theo từ khóa tìm kiếm
        $listProduct = $this->modelHome->searchProducts($keyword);
        
        require_once './views/timKiem.php';
    }
}
