<?php
require_once 'views/layout/header.php';
require_once 'views/layout/menu.php';
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
                            <li class="breadcrumb-item active" aria-current="page">Tài khoản của tôi</li>
                        </ul>
                    </nav>
                </div>
            </div></div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- my account wrapper start -->
    <div class="my-account-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <?php if (!empty($success)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                <?php endif; ?>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                            <div class="row">
                                <!-- My Account Tab Menu Start -->
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#account-info" class="active" data-bs-toggle="tab">
                                            <i class="fa fa-user"></i> Chi tiết tài khoản
                                        </a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->

                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Địa chỉ (KHÔNG active mặc định) -->
                                        

                                        <!-- Thông tin tài khoản (PHẢI active mặc định) -->
                                        <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h5>Account Details</h5>
                                                <div class="account-details-form">
                                                    <form action="<?= BASE_URL . '?act=cap-nhat-thong-tin' ?>" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">Họ tên</label>
                                                                    <input type="text" id="first-name" name="ho_ten"
                                                                           value="<?= htmlspecialchars($user['ho_ten'] ?? '') ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="email" class="required">Email</label>
                                                                    <input type="email" id="email" name="email"
                                                                           value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="phone">Số điện thoại</label>
                                                                    <input type="text" id="phone" name="so_dien_thoai"
                                                                           value="<?= htmlspecialchars($user['so_dien_thoai'] ?? '') ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="single-input-item">
                                                                    <label for="dob">Ngày sinh</label>
                                                                    <input type="date" id="dob" name="ngay_sinh"
                                                                           value="<?= htmlspecialchars($user['ngay_sinh'] ?? '') ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="single-input-item">
                                                                    <label>Giới tính</label><br>
                                                                    <?php $gt = $user['gioi_tinh'] ?? ''; ?>
                                                                    <label class="me-2"><input type="radio" name="gioi_tinh" value="nam" <?= $gt === 'nam' ? 'checked' : '' ?>> Nam</label>
                                                                    <label class="me-2"><input type="radio" name="gioi_tinh" value="nu"  <?= $gt === 'nu'  ? 'checked' : '' ?>> Nữ</label>
                                                                    <label><input type="radio" name="gioi_tinh" value="khac" <?= $gt === 'khac' ? 'checked' : '' ?>> Khác</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label for="address">Địa chỉ</label>
                                                            <textarea id="address" name="dia_chi" rows="3"><?= htmlspecialchars($user['dia_chi'] ?? '') ?></textarea>
                                                        </div>

                                                        <div class="single-input-item">
                                                            <label>Ảnh đại diện</label>
                                                            <div class="mb-2">
                                                                <img id="previewAvt"
                                                                     src="<?= !empty($user['anh_dai_dien']) ? BASE_URL . $user['anh_dai_dien'] : BASE_URL . 'assets/img/user/avatar-placeholder.png' ?>"
                                                                     alt="Avatar" class="img-thumbnail" style="max-width:120px;">
                                                            </div>
                                                            <input type="file" name="anh_dai_dien" accept=".jpg,.jpeg,.png,.webp" onchange="previewAvatar(this)">
                                                        </div>

                                                        <fieldset class="mt-3">
                                                            <legend>Đổi mật khẩu (tuỳ chọn)</legend>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd">Mật khẩu mới</label>
                                                                        <input type="password" id="new-pwd" name="mat_khau" placeholder="Để trống nếu không đổi">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd">Xác nhận mật khẩu</label>
                                                                        <input type="password" id="confirm-pwd" name="xac_nhan_mat_khau" placeholder="Nhập lại mật khẩu mới">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>

                                                        <div class="single-input-item">
                                                            <button class="btn btn-sqr" type="submit">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                    </div>
                                </div>
                                <!-- My Account Tab Content End -->
                            </div>
                        </div>
                        <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
</main>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('previewAvt').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}

// Mở đúng tab theo anchor (VD: ?act=tai-khoan#address-edit)
document.addEventListener('DOMContentLoaded', function () {
    if (location.hash) {
        const trigger = document.querySelector('.myaccount-tab-menu a[href="' + location.hash + '"]');
        const pane    = document.querySelector(location.hash + '.tab-pane');
        if (trigger && pane) {
            // remove active hiện tại
            document.querySelectorAll('.myaccount-tab-menu a').forEach(a => a.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show','active'));

            // set active theo hash
            trigger.classList.add('active');
            pane.classList.add('show','active');
        }
    }
});
</script>

<?php require_once 'views/layout/footer.php'; ?>
