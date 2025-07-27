<!-- Giao diện sửa đơn hàng -->
<?php
include_once './views/layout/header.php';
include_once './views/layout/navbar.php';
include_once './views/layout/sidebar.php';
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Sửa Đơn Hàng</h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">
                <input type="hidden" name="id" value="<?= $donHang['id'] ?>">

                <div class="card-body">
                    <div class="form-group">
                        <label>Người nhận</label>
                        <input type="text" name="ten_nguoi_nhan" value="<?= $donHang['ten_nguoi_nhan'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email người nhận</label>
                        <input type="email" name="email_nguoi_nhan" value="<?= $donHang['email_nguoi_nhan'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>SĐT người nhận</label>
                        <input type="text" name="sdt_nguoi_nhan" value="<?= $donHang['sdt_nguoi_nhan'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ nhận</label>
                        <textarea name="dia_chi_nguoi_nhan" class="form-control"><?= $donHang['dia_chi_nguoi_nhan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tổng tiền</label>
                        <input type="number" name="tong_tien" value="<?= $donHang['tong_tien'] ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Ghi chú</label>
                        <textarea name="ghi_chu" class="form-control"><?= $donHang['ghi_chu'] ?></textarea>
                    </div>
                    <?php if ($donHang['trang_thai_id'] != 1): ?>
                        <input type="hidden" name="phuong_thuc_thanh_toan_id" value="<?= $donHang['phuong_thuc_thanh_toan_id'] ?>">
                        <select class="form-control" disabled>
                            <?php foreach ($phuongThucThanhToanList as $pt): ?>
                                <option <?= $pt['id'] == $donHang['phuong_thuc_thanh_toan_id'] ? 'selected' : '' ?>>
                                    <?= $pt['ten_phuong_thuc'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <select name="phuong_thuc_thanh_toan_id" class="form-control">
                            <?php foreach ($phuongThucThanhToanList as $pt): ?>
                                <option value="<?= $pt['id'] ?>" <?= ($pt['id'] == $donHang['phuong_thuc_thanh_toan_id']) ? 'selected' : '' ?>>
                                    <?= $pt['ten_phuong_thuc'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>


                    <div class="form-group">
                        <label>Trạng thái đơn hàng</label>
                        <select name="trang_thai_id" class="form-control">
                            <?php foreach ($trangThaiDonHangList as $tt): ?>
                                <?php if ($tt['id'] >= $donHang['trang_thai_id']): ?>
                                    <option value="<?= $tt['id'] ?>" <?= ($tt['id'] == $donHang['trang_thai_id']) ? 'selected' : '' ?>>
                                        <?= $tt['ten_trang_thai'] ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </section>
</div>
<?php include_once './views/layout/footer.php'; ?>