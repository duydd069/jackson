<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
?>
<main class="section-padding">
  <div class="container">
    <h3 class="mb-3">Đơn hàng của tôi</h3>

    <?php if (isset($_SESSION['flash'])): ?>
      <div class="alert alert-<?= htmlspecialchars($_SESSION['flash']['type']) ?>">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
      </div>
      <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

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
              <th>Hành động</th>
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
                <td>
                  <?php if ((int)$dh['trang_thai_id'] === 1): ?>
                    <form method="POST" action="<?= BASE_URL . '?act=huy-don-hang' ?>" onsubmit="return confirm('Hủy đơn này?');" class="d-inline">
                      <input type="hidden" name="don_hang_id" value="<?= (int)$dh['id'] ?>">
                      <button type="submit" class="btn btn-sm btn-outline-danger">Hủy đơn</button>
                    </form>
                  <?php else: ?>
                    <button class="btn btn-sm btn-outline-secondary" disabled>Hủy</button>
                  <?php endif; ?>
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
