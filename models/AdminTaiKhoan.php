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
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM danh_mucs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    // Lấy user theo ID

    public function getUserById(int $id): ?array
    {
        $sql = "SELECT id, ho_ten, email, so_dien_thoai, ngay_sinh, gioi_tinh, dia_chi, anh_dai_dien, mat_khau
            FROM tai_khoans WHERE id = :id LIMIT 1";
        $stm = $this->conn->prepare($sql);
        $stm->execute([':id' => $id]);
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    // Kiểm tra email đã tồn tại ở tài khoản khác
    public function emailExistsOther(string $email, int $excludeId): bool
    {
        $sql = "SELECT 1 FROM tai_khoans WHERE email = :email AND id <> :id LIMIT 1";
        $stm = $this->conn->prepare($sql);
        $stm->execute([':email' => $email, ':id' => $excludeId]);
        return (bool)$stm->fetchColumn();
    }

    // Cập nhật hồ sơ (chỉ update field nào có giá trị)
    public function updateUserProfile(int $id, array $data): bool
    {
        $fields = [
            'ho_ten'        => $data['ho_ten']        ?? null,
            'email'         => $data['email']         ?? null,
            'so_dien_thoai' => $data['so_dien_thoai'] ?? null,
            'ngay_sinh'     => $data['ngay_sinh']     ?? null,
            'gioi_tinh'     => $data['gioi_tinh']     ?? null,
            'dia_chi'       => $data['dia_chi']       ?? null,
        ];
        if (!empty($data['anh_dai_dien'])) $fields['anh_dai_dien'] = $data['anh_dai_dien'];
        if (!empty($data['mat_khau']))     $fields['mat_khau']     = $data['mat_khau']; // theo yêu cầu học tập: không hash

        $set = [];
        $params = [':id' => $id];
        foreach ($fields as $k => $v) {
            if ($v !== null) {
                $set[] = "$k = :$k";
                $params[":$k"] = $v;
            }
        }
        if (!$set) return true;

        $sql = "UPDATE tai_khoans SET " . implode(', ', $set) . " WHERE id = :id";
        $stm = $this->conn->prepare($sql);
        return $stm->execute($params);
    }
}
