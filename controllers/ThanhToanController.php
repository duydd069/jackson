<?php 
class ThanhToanController
{
    public $thanhToanModel;
    public $gioHangModel;

    public function __construct()
    {
        $this->gioHangModel = new GioHangModel();
        $this->thanhToanModel = new ThanhToanModel();
    }
    public function thanhToan()
    {
        require_once './views/thanhToan.php';
    }
}
?>