<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
// Input: $don (bản ghi đơn hàng đã join tên PTTT & tên trạng thái), $items (chi tiết), $ngayGiaoDuKien (DateTime)
?>
<main class="section-padding">
    <div class="container">
        <h3 class="mb-3">Chi tiết đơn hàng #<?= htmlspecialchars($don['ma_don_hang']) ?></h3>
        <div class="row">
            <div class="col-lg-7">
                <div class="card p-3 mb-3">
                    <h5>Thông tin đơn</h5>
                    <p><strong>Trạng thái:</strong> <?= htmlspecialchars($don['ten_trang_thai'] ?? 'N/A') ?></p>
                    <p><strong>Ngày đặt:</strong> <?= htmlspecialchars($don['ngay_dat']) ?></p>
                    <p><strong>Dự kiến giao:</strong> <?= $ngayGiaoDuKien->format('Y-m-d') ?></p>
                    <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($don['ten_phuong_thuc'] ?? 'N/A') ?></p>
                </div>
                <div class="card p-3">
                    <h5>Sản phẩm</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr><th>Sản phẩm</th><th>Đơn giá</th><th>SL</th><th>Thành tiền</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $it): ?>
                                <tr>
                                    <td><?= htmlspecialchars($it['ten_san_pham']) ?></td>
                                    <td><?= number_format($it['don_gia'], 0, ',', '.') ?>₫</td>
                                    <td><?= (int)$it['so_luong'] ?></td>
                                    <td><?= number_format($it['thanh_tien'], 0, ',', '.') ?>₫</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tổng tiền</strong></td>
                                    <td><strong><?= number_format($don['tong_tien'], 0, ',', '.') ?>₫</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card p-3">
                    <h5>Người nhận</h5>
                    <p><strong>Tên:</strong> <?= htmlspecialchars($don['ten_nguoi_nhan']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($don['email_nguoi_nhan']) ?></p>
                    <p><strong>SĐT:</strong> <?= htmlspecialchars($don['sdt_nguoi_nhan']) ?></p>
                    <p><strong>Địa chỉ:</strong> <?= nl2br(htmlspecialchars($don['dia_chi_nguoi_nhan'])) ?></p>
                    <?php if (!empty($don['ghi_chu'])): ?>
                        <p><strong>Ghi chú:</strong> <?= nl2br(htmlspecialchars($don['ghi_chu'])) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once './views/layout/footer.php'; ?>
