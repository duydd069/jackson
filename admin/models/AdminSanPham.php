<?php
class AdminSanPham {

    public $conn;
    public function __construct() {
        // Kết nối đến cơ sở dữ liệu
        $this->conn = connectDB();
    }
    public function getAllSanPham() {
        try {
            $sql = "SELECT * FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


}