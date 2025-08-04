    <!-- Start Header Area -->
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="<?= BASE_URL ?>">
                                    <img src="assets/img/logo/logo.png" alt="Brand Logo">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li>
                                                <a href="<?= BASE_URL . '?act=san-pham'?>">Sản phẩm <i class="fa fa-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <?php foreach ($listCategory as $category): ?>
                                                        <?php if ($category['id'] != 0): ?> <!-- Loại trừ id = 0 -->
                                                            <li>
                                                                <a href="<?= BASE_URL . '?act=danh-muc-san-pham&id=' . $category['id'] ?>">
                                                                    <?= htmlspecialchars($category['ten_danh_muc']) ?>
                                                                </a>
                                                            </li>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                            <li><a href="contact-us.html">Giới thiệu</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-container">
                                    <button class="search-trigger d-xl-none d-lg-block"><i class="pe-7s-search"></i></button>
                                    <form class="header-search-box d-lg-none d-xl-block">
                                        <input type="text" placeholder="Tìm kiếm sản phẩm" class="header-search-field">
                                        <button class="header-search-btn"><i class="pe-7s-search"></i></button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li class="user-hover">
                                            <a href="#"><i class="pe-7s-user"></i></a>
                                            <ul class="dropdown-list">
                                                <?php if (isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
                                                    <li><strong>👋 Xin chào, <?= $_SESSION['user']['ho_ten'] ?? $_SESSION['admin']['ho_ten'] ?></strong></li>
                                                    <li><a href="<?= BASE_URL ?>?act=tai-khoan">Tài khoản</a></li>
                                                    <li><a href="<?= BASE_URL ?>?act=logout">Đăng xuất</a></li>
                                                <?php else: ?>
                                                    <li><a href="<?= BASE_URL ?>?act=form-login">Đăng nhập</a></li>
                                                    <li><a href="<?= BASE_URL ?>?act=dang-ky">Đăng ký</a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>

                                        <li>
                                            <a href="<?= BASE_URL ?>?act=gio-hang" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <!-- mini cart area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->
    </header>
    <!-- end Header Area -->