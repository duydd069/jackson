<?php
class AdminTaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }


    public function getTaiKhoanByEmail($email)
    {
        $sql = "SELECT * FROM tai_khoans WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
    public function insertTaiKhoan($ho_ten, $email, $mat_khau)
    {
        $sql = "INSERT INTO tai_khoans 
        (ho_ten, email, mat_khau, chuc_vu_id, trang_thai, anh_dai_dien, ngay_sinh, so_dien_thoai, gioi_tinh, dia_chi) 
        VALUES 
        (:ho_ten, :email, :mat_khau, 2, 1, NULL, NULL, NULL, NULL, NULL)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':ho_ten' => $ho_ten,
            ':email' => $email,
            ':mat_khau' => $mat_khau
        ]);
    }
}
