<?php
require_once 'views/layout/header.php';
require_once 'views/layout/menu.php';
?>
<style>
    .hero-slider-item {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;

        height: 400px;
        position: relative;
    }

    @media (max-width: 768px) {
        .hero-slider-item {
            height: 250px;
        }
    }
</style>

<body>

    <main>
        <!-- hero slider area start -->
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide1.jpg">
                        <div class="container">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide2.jpg">
                        <div class="container">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide3.jpg">
                        <div class="container">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide4.jpg">
                        <div class="container">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slide5.jpg">
                        <div class="container">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
            </div>

        </section>
        <!-- hero slider area end -->


        <!-- service policy area start -->
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Giao hàng</h6>
                                <p>Miễn phí giao hàng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hỗ trợ</h6>
                                <p>Hỗ trợ 24/7</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Hoàn tiền</h6>
                                <p>30 ngày hoàn tiền miễn phí</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Thanh toán</h6>
                                <p>Bảo mật thanh toán</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->

        <!-- banner statistics area start -->
        <div class="banner-statistics-area">
            <div class="container">
                <div class="row row-20 mtn-20">


                </div>
            </div>
        </div>
        <!-- banner statistics area end -->
        <!-- featured product area start -->
        <section class="feature-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm</h2>
                            <p class="sub-title">Sản phẩm bán chạy trong tuần này</p>
                        </div>
                        <!-- section title end -->
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($listProduct as $sp): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card h-100 text-center">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id=' . $sp['san_pham_id'] ?>">
                                    <img src="<?= BASE_URL . $sp['hinh_anh'] ?>" class="card-img-top" alt="<?= $sp['ten_san_pham'] ?>" style="height: 200px; object-fit: cover;">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $sp['ten_san_pham'] ?></h5>
                                    <?php if ($sp['gia_khuyen_mai'] && $sp['gia_khuyen_mai'] < $sp['gia_san_pham']): ?>
                                        <p class="card-text text-danger fw-bold"><?= number_format($sp['gia_khuyen_mai'], 0, ',', '.') ?> đ</p>
                                        <p class="text-muted"><del><?= number_format($sp['gia_san_pham'], 0, ',', '.') ?> đ</del></p>
                                    <?php else: ?>
                                        <p class="card-text"><?= number_format($sp['gia_san_pham'], 0, ',', '.') ?> đ</p>
                                    <?php endif; ?>
                                    <form action="<?= BASE_URL . '?act=them-vao-gio-hang&id=' . $sp['san_pham_id'] ?>" method="POST">
                                        <button class="btn btn-sm btn-outline-primary">Thêm vào giỏ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            </div>
        </section>

        <!-- featured product area end -->


    </main>




    <!-- offcanvas mini cart start -->
    <!-- offcanvas mini cart end -->
    <?php require_once 'views/layout/footer.php'; ?>