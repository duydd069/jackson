<?php
class AdminSanPham {

    public $conn;
    public function __construct() {
        // Kết nối đến cơ sở dữ liệu
        $this->conn = connectDB();
    }
    public function getAllSanPham() {
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
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
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
    public function addSanPham($ten_san_pham, $gia_san_pham, $gia_khuyen_mai, $so_luong, $ngay_nhap, $danh_muc_id, $trang_thai, $mo_ta, $hinh_anh) {
        try {
            $sql = "INSERT INTO san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
            VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
