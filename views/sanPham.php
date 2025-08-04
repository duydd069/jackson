<?php
require_once 'views/layout/header.php';
require_once 'views/layout/menu.php';
?>

<body>
    <main>
        <!-- Banner statistics area start -->
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">
                    <!-- Bạn có thể thêm nội dung cho banner ở đây -->
                </div>
            </div>
        </div>
        <!-- Banner statistics area end -->

        <!-- Featured product area start -->
        <section class="feature-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center mb-4">
                        <h2 class="title">Sản phẩm</h2>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($listProduct as $sp): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
                            <div class="card w-100 h-100 text-center shadow-sm">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id=' . $sp['san_pham_id'] ?>">
                                    <img src="<?= BASE_URL . $sp['hinh_anh'] ?>"
                                        class="card-img-top"
                                        alt="<?= htmlspecialchars($sp['ten_san_pham']) ?>"
                                        style="height: 200px; object-fit: cover;">
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title"><?= htmlspecialchars($sp['ten_san_pham']) ?></h6>
                                    <?php if ($sp['gia_khuyen_mai'] && $sp['gia_khuyen_mai'] < $sp['gia_san_pham']): ?>
                                        <p class="text-danger fw-bold"><?= number_format($sp['gia_khuyen_mai'], 0, ',', '.') ?> đ</p>
                                        <p class="text-muted"><del><?= number_format($sp['gia_san_pham'], 0, ',', '.') ?> đ</del></p>
                                    <?php else: ?>
                                        <p class="text-dark"><?= number_format($sp['gia_san_pham'], 0, ',', '.') ?> đ</p>
                                    <?php endif; ?>
                                    <form action="<?= BASE_URL . '?act=them-vao-gio-hang&id=' . $sp['san_pham_id'] ?>" method="POST">
                                        <button class="btn btn-primary">Thêm vào giỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <!-- Featured product area end -->
    </main>

    <?php require_once 'views/layout/footer.php'; ?>
</body>
</html>