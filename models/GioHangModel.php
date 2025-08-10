<?php 
class GioHangModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getGioHangByTaiKhoanId($taiKhoanId) {
        $sql = "SELECT * FROM gio_hangs WHERE tai_khoan_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$taiKhoanId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrCreateGioHang($taiKhoanId) {
        $gioHang = $this->getGioHangByTaiKhoanId($taiKhoanId);
        if ($gioHang) return $gioHang;

        $sql = "INSERT INTO gio_hangs (tai_khoan_id) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$taiKhoanId]);

        return $this->getGioHangByTaiKhoanId($taiKhoanId);
    }

    public function getChiTietGioHang($gioHangId) {
        $sql = "SELECT * FROM chi_tiet_gio_hangs WHERE gio_hang_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$gioHangId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function themSanPham($gioHangId, $sanPhamId, $soLuong) {
        $check = "SELECT * FROM chi_tiet_gio_hangs WHERE gio_hang_id = ? AND san_pham_id = ?";
        $stmt = $this->conn->prepare($check);
        $stmt->execute([$gioHangId, $sanPhamId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = so_luong + ? WHERE gio_hang_id = ? AND san_pham_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$soLuong, $gioHangId, $sanPhamId]);
        } else {
            $sql = "INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$gioHangId, $sanPhamId, $soLuong]);
        }
    }

    public function getSanPhamById($id) {
    $sql = "SELECT * FROM san_phams WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}


    public function capNhatSoLuong($gioHangId, $sanPhamId, $soLuongMoi) {
        $sql = "UPDATE chi_tiet_gio_hangs SET so_luong = ? WHERE gio_hang_id = ? AND san_pham_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$soLuongMoi, $gioHangId, $sanPhamId]);
    }

    public function xoaSanPhamTrongGio($gioHangId, $sanPhamId) {
        $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = ? AND san_pham_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$gioHangId, $sanPhamId]);
    }
    
    public function getAllPhuongThucThanhToan() {
        $sql = "SELECT * FROM phuong_thuc_thanh_toans";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function xoaGioHang($taiKhoanId) {
    // Lấy ID giỏ hàng
    $sql = "SELECT id FROM gio_hangs WHERE tai_khoan_id = :tk_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':tk_id' => $taiKhoanId]);
    $gioHang = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($gioHang) {
        // Xoá chi tiết trước
        $sql = "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gh_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':gh_id' => $gioHang['id']]);
    }

    
}
public function getThongTinKhachHang($taiKhoanId)
    {
        $sql = "SELECT id, ho_ten, email, so_dien_thoai, dia_chi
                FROM tai_khoans
                WHERE id = :id
                LIMIT 1";
        $stm = $this->conn->prepare($sql);
        $stm->execute([':id' => $taiKhoanId]);
        return $stm->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy cart items của user + tên sp + đơn giá (ưu tiên giá_khuyến_mãi nếu có)
    public function getCartItemsByUserId($taiKhoanId)
    {
        $sql = "
            SELECT
                sp.id            AS san_pham_id,
                sp.ten_san_pham  AS ten_san_pham,
                COALESCE(sp.gia_khuyen_mai, sp.gia_san_pham) AS don_gia,
                ctgh.so_luong    AS so_luong,
                (ctgh.so_luong * COALESCE(sp.gia_khuyen_mai, sp.gia_san_pham)) AS thanh_tien
            FROM gio_hangs gh
            JOIN chi_tiet_gio_hangs ctgh ON gh.id = ctgh.gio_hang_id
            JOIN san_phams sp            ON sp.id = ctgh.san_pham_id
            WHERE gh.tai_khoan_id = :uid
            ORDER BY ctgh.id DESC
        ";
        $stm = $this->conn->prepare($sql);
        $stm->execute([':uid' => $taiKhoanId]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
// Lấy id giỏ hàng theo tài khoản
public function getGioHangIdByUser(int $taiKhoanId): ?int
{
    $sql = "SELECT id FROM gio_hangs WHERE tai_khoan_id = :uid LIMIT 1";
    $stm = $this->conn->prepare($sql);
    $stm->execute([':uid' => $taiKhoanId]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    return $row ? (int)$row['id'] : null;
}

// Xoá sạch các dòng trong giỏ hàng của user
public function clearCartByUser(int $taiKhoanId): bool
{
    $this->conn->beginTransaction();
    try {
        $gioHangId = $this->getGioHangIdByUser($taiKhoanId);
        if ($gioHangId) {
            $delCt = $this->conn->prepare(
                "DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gid"
            );
            $delCt->execute([':gid' => $gioHangId]);
        }
        $this->conn->commit();
        return true;
    } catch (Throwable $e) {
        $this->conn->rollBack();
        throw $e;
    }
}


}

?>