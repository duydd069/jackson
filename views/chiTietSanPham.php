<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
?>

<main>
    <!-- breadcrumb -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="index.php?act=danhsachsanpham">Sản phẩm</a></li>
                            <li class="breadcrumb-item active"><?= $sanPham['ten_san_pham'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- product detail -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-inner">
                        <div class="row">
                            <!-- ảnh -->
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>" style="width:100%; object-fit:cover;">
                                    </div>
                                </div>
                            </div>

                            <!-- thông tin -->
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <h3 class="product-name"><?= $sanPham['ten_san_pham'] ?></h3>

                                    <div class="price-box">
                                        <?php if (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] < $sanPham['gia_san_pham']): ?>
                                            <span class="price-regular text-danger"><?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?> đ</span>
                                            <span class="price-old"><del><?= number_format($sanPham['gia_san_pham'], 0, ',', '.') ?> đ</del></span>
                                        <?php else: ?>
                                            <span class="price-regular"><?= number_format($sanPham['gia_san_pham'], 0, ',', '.') ?> đ</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span>
                                            <?= $sanPham['so_luong'] > 0 ? 'Còn hàng: ' . $sanPham['so_luong'] . ' sản phẩm' : 'Hết hàng' ?>
                                        </span>
                                    </div>

                                    <?php if (!empty($sanPham['mo_ta'])): ?>
                                        <p class="pro-desc"><?= nl2br($sanPham['mo_ta']) ?></p>
                                    <?php endif; ?>

                                    <?php if ($sanPham['so_luong'] > 0): ?>
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h6 class="option-title">Số lượng:</h6>
                                            <form action="<?= BASE_URL . '?act=them-vao-gio-hang' ?>" method="POST" class="d-flex align-items-center">
                                                <div class="quantity mx-2">
                                                    <div class="pro-qty">
                                                        <input type="number" name="so_luong" value="1" min="1" max="<?= $sanPham['so_luong'] ?>">
                                                    </div>
                                                </div>
                                                <input type="hidden" name="id" value="<?= $sanPham['id'] ?>">
                                                <button type="submit" class="btn btn-cart2">Thêm vào giỏ</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Optional social icons -->
                                    <div class="like-icon mt-3">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i> Like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i> Tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i> Pin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- product-details-inner -->
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once './views/layout/footer.php'; ?>
