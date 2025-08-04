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
}

?>