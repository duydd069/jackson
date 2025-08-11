<?php
class ThanhToanModel
{
    private $conn;
    public function __construct() { $this->conn = connectDB(); }

    public function tinhPhiVanChuyen(float $subTotal): float
    {
        return 0.0; // miễn phí ship demo
    }

    public function getPhuongThucThanhToan(): array
    {
        $sql = "SELECT id, ten_phuong_thuc FROM phuong_thuc_thanh_toans ORDER BY id ASC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function taoMaDonHang(): string
    {
        return 'DH' . date('YmdHis') . strtoupper(substr(bin2hex(random_bytes(2)), 0, 4));
    }

    public function taoDonHang(array $data, array $cartItems): int
    {
        // $data gồm: tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan,
        // dia_chi_nguoi_nhan, ghi_chu, phuong_thuc_thanh_toan_id, sub_total, shipping, grand_total
        $this->conn->beginTransaction();
        try {
            $ma = $this->taoMaDonHang();
            $ngayDat = date('Y-m-d');
            $trangThaiMacDinh = 1; // giả định 1 = Chờ xác nhận

            $sqlDon = "INSERT INTO don_hangs
                (ma_don_hang, tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan,
                 dia_chi_nguoi_nhan, ngay_dat, tong_tien, ghi_chu, phuong_thuc_thanh_toan_id, trang_thai_id)
                VALUES
                (:ma, :uid, :ten, :email, :sdt, :dia_chi, :ngay_dat, :tong_tien, :ghi_chu, :pttt, :trang_thai)";
            $stmDon = $this->conn->prepare($sqlDon);
            $stmDon->execute([
                ':ma'        => $ma,
                ':uid'       => $data['tai_khoan_id'],
                ':ten'       => $data['ten_nguoi_nhan'],
                ':email'     => $data['email_nguoi_nhan'],
                ':sdt'       => $data['sdt_nguoi_nhan'],
                ':dia_chi'   => $data['dia_chi_nguoi_nhan'],
                ':ngay_dat'  => $ngayDat,
                ':tong_tien' => $data['grand_total'],
                ':ghi_chu'   => $data['ghi_chu'] ?? null,
                ':pttt'      => $data['phuong_thuc_thanh_toan_id'],
                ':trang_thai'=> $trangThaiMacDinh,
            ]);
            $donHangId = (int)$this->conn->lastInsertId();

            $sqlCt = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien)
                      VALUES (:don_hang_id, :sp_id, :don_gia, :so_luong, :thanh_tien)";
            $stmCt = $this->conn->prepare($sqlCt);

            foreach ($cartItems as $it) {
                $stmCt->execute([
                    ':don_hang_id' => $donHangId,
                    ':sp_id'       => $it['san_pham_id'],
                    ':don_gia'     => $it['don_gia'],
                    ':so_luong'    => $it['so_luong'],
                    ':thanh_tien'  => $it['thanh_tien'],
                ]);
            }

            $this->conn->commit();
            return $donHangId;
        } catch (Throwable $e) {
            $this->conn->rollBack();
            throw $e;
        }
    }

    public function getDonHangById(int $id): ?array
    {
        $sql = "SELECT dh.*,
                       pttt.ten_phuong_thuc,
                       ttdh.ten_trang_thai
                FROM don_hangs dh
                LEFT JOIN phuong_thuc_thanh_toans pttt ON pttt.id = dh.phuong_thuc_thanh_toan_id
                LEFT JOIN trang_thai_don_hangs ttdh ON ttdh.id = dh.trang_thai_id
                WHERE dh.id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->execute([':id' => $id]);
        $row = $stm->fetch(PDO::FETCH_ASSOC);
        return $row ?: null;
    }

    public function getChiTietDonHang(int $donHangId): array
    {
        $sql = "SELECT ctdh.*, sp.ten_san_pham
                FROM chi_tiet_don_hangs ctdh
                JOIN san_phams sp ON sp.id = ctdh.san_pham_id
                WHERE ctdh.don_hang_id = :id";
        $stm = $this->conn->prepare($sql);
        $stm->execute([':id' => $donHangId]);
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDonHangGanNhatByUser(int $uid): ?array
{
    $sql = "SELECT dh.*,
                   pttt.ten_phuong_thuc,
                   ttdh.ten_trang_thai
            FROM don_hangs dh
            LEFT JOIN phuong_thuc_thanh_toans pttt ON pttt.id = dh.phuong_thuc_thanh_toan_id
            LEFT JOIN trang_thai_don_hangs ttdh    ON ttdh.id = dh.trang_thai_id
            WHERE dh.tai_khoan_id = :uid
            ORDER BY dh.id DESC
            LIMIT 1";
    $stm = $this->conn->prepare($sql);
    $stm->execute([':uid' => $uid]);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}
public function getDonHangsByUser(int $uid): array
{
    $sql = "SELECT dh.id, dh.ma_don_hang, dh.ngay_dat, dh.tong_tien,
                   pttt.ten_phuong_thuc, ttdh.ten_trang_thai
            FROM don_hangs dh
            LEFT JOIN phuong_thuc_thanh_toans pttt ON pttt.id = dh.phuong_thuc_thanh_toan_id
            LEFT JOIN trang_thai_don_hangs ttdh    ON ttdh.id = dh.trang_thai_id
            WHERE dh.tai_khoan_id = :uid
            ORDER BY dh.id DESC";
    $stm = $this->conn->prepare($sql);
    $stm->execute([':uid' => $uid]);
    return $stm->fetchAll(PDO::FETCH_ASSOC);
}

}
