<?php 

class HomeController
{

    public $modelSanPham;

    public function __construct()
    {
        // Khởi tạo model SanPham
        $this->modelSanPham = new SanPham();
    }

    public function home()
    {
        require_once './views/trangChu.php';
    }
    public function trangchu()
    {
        echo "Chào mừng bạn đến với Trang Chủ!";
    }
    public function danhSachSanPham()
    {
        $listProduct = $this->modelSanPham->getAllProducts();
        require_once './views/listProduct.php';
    }

}