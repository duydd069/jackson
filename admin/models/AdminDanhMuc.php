<?php
class AdminDanhMuc {

    public $conn;

    public function __construct() {
        // Kết nối đến cơ sở dữ liệu
        $this->conn = connectDB();
    }
    public function getAllDanhMuc() {
        try {
            $sql = "SELECT * FROM danh_mucs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function addDanhMuc($ten_danh_muc, $mo_ta) {
        try {
            $sql = "INSERT INTO danh_mucs (ten_danh_muc, mo_ta)
            VALUES (:ten_danh_muc, :mo_ta)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailDanhMuc($id) {
        try {
            $sql = "SELECT * FROM danh_mucs WHERE id = :id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function updateDanhMuc($id, $ten_danh_muc, $mo_ta) {
        try {
            $sql = "UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':ten_danh_muc' => $ten_danh_muc,
                ':mo_ta' => $mo_ta
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function countSanPhamByDanhMuc($id){
        try{
            $sql = "SELECT COUNT(*) as total FROM san_phams WHERE danh_muc_id = :id";
            $stmt = $this ->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            $result = $stmt->fetch();
            return $result['total'];
        }
        catch (Exception $e)   {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function chuyenSanPhamVeKhongDanhMuc($id){
        try{
            $sql = "UPDATE san_phams SET danh_muc_id = 0 WHERE danh_muc_id = :id";
            $stmt = $this ->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return true;

        } catch(Exception $e){
            echo "Lỗi : " .$e->getMessage();
        }
    }
    public function destroyDanhMuc($id) {
        try {
            $sql = "DELETE FROM danh_mucs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}