<?php
class AdminDonHang
{

    public $conn;
    public function __construct()
    {
        // Kết nối đến cơ sở dữ liệu
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        try {
            $sql = "SELECT 
                don_hangs.*,
                trang_thai_don_hangs.ten_trang_thai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getDonHangById($id)
    {
        try {
            $sql = "SELECT 
                    don_hangs.*,
                    trang_thai_don_hangs.ten_trang_thai,
                    phuong_thuc_thanh_toans.ten_phuong_thuc,
                    tai_khoans.ho_ten,
                    tai_khoans.email,
                    tai_khoans.so_dien_thoai
                FROM don_hangs
                INNER JOIN trang_thai_don_hangs 
                    ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
                INNER JOIN phuong_thuc_thanh_toans 
                    ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
                INNER JOIN tai_khoans 
                    ON don_hangs.tai_khoan_id = tai_khoans.id
                WHERE don_hangs.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getListSpDonHang($don_hang_id)
{
    try {
        $sql = "SELECT * FROM chi_tiet_don_hangs
                WHERE don_hang_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $don_hang_id]);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


    public function getAllPhuongThucThanhToan()
    {
        try {
            $sql = "SELECT * FROM phuong_thuc_thanh_toans";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hangs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }




    public function updateDonHang($id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $tong_tien, $ghi_chu, $phuong_thuc_thanh_toan_id, $trang_thai_id)
    {
        try {
            $sql = "UPDATE don_hangs SET 
                    ten_nguoi_nhan = :ten_nguoi_nhan,
                    email_nguoi_nhan = :email_nguoi_nhan,
                    sdt_nguoi_nhan = :sdt_nguoi_nhan,
                    dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan,
                    tong_tien = :tong_tien,
                    ghi_chu = :ghi_chu,
                    phuong_thuc_thanh_toan_id = :phuong_thuc_thanh_toan_id,
                    trang_thai_id = :trang_thai_id
                WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':tong_tien' => $tong_tien,
                ':ghi_chu' => $ghi_chu,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':trang_thai_id' => $trang_thai_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


        ///Xóa sản phẩm
        public function deleteDonHang($id) {
            try {
                $sql = "DELETE FROM don_hangs WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':id' => $id]);
                return true;
            } catch (Exception $e) {
                echo "Lỗi: " . $e->getMessage();
                return false;
            }
        }
}
