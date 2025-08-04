<?php
class Home {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllProducts() {
        try {
        $sql = "SELECT 
                    san_phams.id as san_pham_id,
                    san_phams.ten_san_pham,
                    san_phams.gia_san_pham,
                    san_phams.gia_khuyen_mai,
                    san_phams.so_luong,
                    san_phams.ngay_nhap,
                    san_phams.danh_muc_id,
                    san_phams.trang_thai,
                    san_phams.mo_ta,
                    san_phams.hinh_anh,
                    danh_mucs.id as danh_muc_id_full,
                    danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.trang_thai = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
    }
    public function getAllCategories() {
        try{
            $sql = "SELECT * FROM danh_mucs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    public function getSanPhamById($id) {
    try {
        $sql = "SELECT sp.*, dm.ten_danh_muc 
                FROM san_phams sp 
                LEFT JOIN danh_mucs dm ON sp.danh_muc_id = dm.id
                WHERE sp.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
    }
}
