<?php

class AdminTaiKhoan
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // 1. Lấy danh sách admin (chuc_vu_id = 1)
    public function getAllAdmin()
    {
        $sql = "SELECT * FROM tai_khoans WHERE chuc_vu_id = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 2. Lấy danh sách user (chuc_vu_id = 2)
    public function getAllUser()
    {
        $sql = "SELECT * FROM tai_khoans WHERE chuc_vu_id = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // 3. Chuyển admin thành user (chuc_vu_id = 2)
    public function chuyenAdminVeUser($id)
    {
        $sql = "UPDATE tai_khoans SET chuc_vu_id = 2 WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
    }

    // 4. Toggle trạng thái user (ban hoặc mở ban)
    public function toggleTrangThaiUser($id)
    {
        // Lấy trạng thái hiện tại
        $sql = "SELECT trang_thai FROM tai_khoans WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $user = $stmt->fetch();

        $newTrangThai = ($user['trang_thai'] == 1) ? 0 : 1;

        $sql = "UPDATE tai_khoans SET trang_thai = :trang_thai WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':trang_thai' => $newTrangThai,
            ':id' => $id
        ]);
    }
}
