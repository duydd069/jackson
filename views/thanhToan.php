<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
?>
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row"><div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>?act=shop">Cửa hàng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                        </ul>
                    </nav>
                </div>
            </div></div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <form method="POST" action="<?= BASE_URL . '?act=dat-hang' ?>" id="formThanhToan">
                <div class="row">
                    <!-- Thông tin người nhận -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông tin người nhận</h5>
                            <div class="billing-form-wrap">
                                <div class="single-input-item">
                                    <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                    <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan"
                                           value="<?= htmlspecialchars($khachHang['ho_ten'] ?? '') ?>" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="email_nguoi_nhan" class="required">Địa chỉ Email</label>
                                    <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan"
                                           value="<?= htmlspecialchars($khachHang['email'] ?? '') ?>" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="sdt_nguoi_nhan" class="required">Số điện thoại</label>
                                    <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan"
                                           value="<?= htmlspecialchars($khachHang['so_dien_thoai'] ?? '') ?>" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ nhận hàng</label>
                                    <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan"
                                           value="<?= htmlspecialchars($khachHang['dia_chi'] ?? '') ?>" required />
                                </div>

                                <div class="single-input-item">
                                    <label for="ghi_chu">Ghi chú</label>
                                    <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3" placeholder="Ghi chú"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tóm tắt + PTTT -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Tóm tắt đơn hàng</h5>
                            <div class="order-summary-content">
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr><th>Products</th><th>Total</th></tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($cartItems)): foreach ($cartItems as $it): ?>
                                            <tr>
                                                <td>
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id=' . $it['san_pham_id'] ?>">
                                                        <?= htmlspecialchars($it['ten_san_pham']) ?>
                                                    </a>
                                                    <strong> × <?= (int)$it['so_luong'] ?></strong>
                                                </td>
                                                <td><?= number_format($it['thanh_tien'], 0, ',', '.') ?>₫</td>
                                            </tr>
                                        <?php endforeach; else: ?>
                                            <tr><td colspan="2">Giỏ hàng đang trống.</td></tr>
                                        <?php endif; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr><td>Tạm tính</td><td><strong><?= number_format($subTotal, 0, ',', '.') ?>₫</strong></td></tr>
                                            <tr><td>Phí vận chuyển</td><td><strong><?= number_format($shipping, 0, ',', '.') ?>₫</strong></td></tr>
                                            <tr><td>Thành tiền</td><td><strong><?= number_format($grandTotal, 0, ',', '.') ?>₫</strong></td></tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Phương thức thanh toán -->
                                <div class="order-payment-method">
                                    <?php foreach ($paymentMethods as $i => $pm): ?>
                                        <div class="single-payment-method <?= $i === 0 ? 'show' : '' ?>">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio"
                                                           id="pm<?= (int)$pm['id'] ?>"
                                                           name="paymentmethod"
                                                           value="<?= (int)$pm['id'] ?>"
                                                           class="custom-control-input"
                                                           <?= $i === 0 ? 'checked' : '' ?> />
                                                    <label class="custom-control-label" for="pm<?= (int)$pm['id'] ?>">
                                                        <?= htmlspecialchars($pm['ten_phuong_thuc']) ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                    <!-- Khung QR: chỉ hiện khi chọn PTTT id=2 -->
                                    <div id="qrContainer" class="text-center mt-3" style="display:none;">
                                        <p>Quét mã để thanh toán:</p>
                                        <img src="assets/img/qr.jpg" alt="QR thanh toán" style="max-width:260px;">
                                        <!-- Anh thay ảnh QR thật tại assets/img/qr_demo.png -->
                                    </div>

                                    <div class="summary-footer-area mt-3">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Tôi đồng ý với điều khoản.</label>
                                        </div>

                                        <!-- Nếu muốn gửi total lên server (không bắt buộc) -->
                                        <input type="hidden" name="tong_tien" value="<?= (float)$grandTotal ?>">

                                        <button type="submit" class="btn btn-sqr">Thanh toán</button>
                                    </div>
                                </div>
                                <!-- /PTTT -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php include_once './views/layout/footer.php'; ?>
<script>
// Hiện/ẩn QR khi chọn phương thức có id = 2
document.querySelectorAll('input[name="paymentmethod"]').forEach(function(r){
    r.addEventListener('change', function(){
        var showQR = (parseInt(this.value) === 2);
        document.getElementById('qrContainer').style.display = showQR ? 'block' : 'none';
    });
});
// Khởi tạo theo radio đang checked
(function(){
    var checked = document.querySelector('input[name="paymentmethod"]:checked');
    if (checked) {
        document.getElementById('qrContainer').style.display = (parseInt(checked.value) === 2) ? 'block' : 'none';
    }
})();
</script>