<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
?>
<main class="section-padding">
  <div class="container">
    <h3 class="mb-3">Đơn hàng của tôi</h3>

    <?php if (empty($orders)): ?>
      <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
    <?php else: ?>
      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
          <thead>
            <tr>
              <th>Mã đơn</th>
              <th>Ngày đặt</th>
              <th>Trạng thái</th>
              <th>PT thanh toán</th>
              <th>Tổng tiền</th>
              <th>Xem</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $dh): ?>
              <tr>
                <td>#<?= htmlspecialchars($dh['ma_don_hang']) ?></td>
                <td><?= htmlspecialchars($dh['ngay_dat']) ?></td>
                <td><?= htmlspecialchars($dh['ten_trang_thai'] ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($dh['ten_phuong_thuc'] ?? 'N/A') ?></td>
                <td><?= number_format($dh['tong_tien'], 0, ',', '.') ?>₫</td>
                <td>
                  <a class="btn btn-sm btn-primary"
                     href="<?= BASE_URL . '?act=xem-don-hang&id=' . (int)$dh['id'] ?>">
                     Chi tiết
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</main>
<?php include_once './views/layout/footer.php'; ?>
