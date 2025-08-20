<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
?>

<!-- Start Banner Area -->

<!-- End Banner Area -->

<!-- Start Products Area -->
<section class="section-padding">
    <div class="container">
        <!-- Thông báo -->
        <?php if (isset($_SESSION['cart_error_msg'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['cart_error_msg'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['cart_error_msg']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['cart_success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['cart_success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['cart_success']); ?>
        <?php endif; ?>
        
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Danh mục sản phẩm</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php foreach ($listCategory as $category): ?>
                                <?php if ($category['id'] != 0): ?>
                                    <li class="mb-2">
                                        <a href="<?= BASE_URL . '?act=danh-muc-san-pham&id=' . $category['id'] ?>" 
                                           class="<?= $category['id'] == $danhMucHienTai['id'] ? 'text-primary fw-bold' : 'text-dark' ?>">
                                            <?= htmlspecialchars($category['ten_danh_muc']) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="row mb-4">
                    <div class="col-12">
                        <h3 class="mb-3"><?= htmlspecialchars($danhMucHienTai['ten_danh_muc']) ?></h3>
                        <p class="text-muted">Tìm thấy <?= count($listProduct) ?> sản phẩm</p>
                    </div>
                </div>

                <?php if (empty($listProduct)): ?>
                    <div class="alert alert-info">
                        <h5>Không có sản phẩm nào trong danh mục này</h5>
                        <p>Vui lòng chọn danh mục khác hoặc quay lại trang chủ.</p>
                        <a href="<?= BASE_URL ?>?act=san-pham" class="btn btn-primary">Xem tất cả sản phẩm</a>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($listProduct as $product): ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 product-card">
                                    <div class="product-img">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id=' . $product['san_pham_id'] ?>">
                                            <img src="<?= BASE_URL . $product['hinh_anh'] ?>" 
                                                 class="card-img-top" 
                                                 alt="<?= htmlspecialchars($product['ten_san_pham']) ?>"
                                                 style="height: 200px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title">
                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id=' . $product['san_pham_id'] ?>" 
                                               class="text-dark text-decoration-none">
                                                <?= htmlspecialchars($product['ten_san_pham']) ?>
                                            </a>
                                        </h6>
                                        <div class="mt-auto">
                                            <div class="price-section mb-2">
                                                <?php if ($product['gia_khuyen_mai'] && $product['gia_khuyen_mai'] < $product['gia_san_pham']): ?>
                                                    <span class="text-muted text-decoration-line-through">
                                                        <?= number_format($product['gia_san_pham'], 0, ',', '.') ?>₫
                                                    </span>
                                                    <span class="text-danger fw-bold ms-2">
                                                        <?= number_format($product['gia_khuyen_mai'], 0, ',', '.') ?>₫
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-primary fw-bold">
                                                        <?= number_format($product['gia_san_pham'], 0, ',', '.') ?>₫
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted">
                                                    Còn lại: <?= $product['so_luong'] ?>
                                                </small>
                                                <a href="<?= BASE_URL . '?act=them-vao-gio-hang&id=' . $product['san_pham_id'] ?>" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="pe-7s-shopbag"></i> Thêm vào giỏ
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!-- End Products Area -->

<style>
.product-card {
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e9ecef;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.product-img img {
    transition: transform 0.3s;
}

.product-card:hover .product-img img {
    transform: scale(1.05);
}

.price-section {
    min-height: 30px;
}

.card-title a:hover {
    color: #007bff !important;
}
</style>

<?php include_once './views/layout/footer.php'; ?>
