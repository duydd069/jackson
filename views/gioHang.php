<?php
include_once './views/layout/header.php';
include_once './views/layout/menu.php';
?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="shop.html">shop</a></li>
                                <li class="breadcrumb-item active" aria-current="page">cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- cart main wrapper start -->
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Cart Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                        <th class="pro-title">Tên sản phẩm</th>
                                        <th class="pro-price">Đơn giá</th>
                                        <th class="pro-quantity">Số lượng</th>
                                        <th class="pro-subtotal">Thành tiền</th>
                                        <th class="pro-remove">Xóa khỏi giỏ hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dsSanPhamTrongGio as $sp): ?>
                                        <tr>
                                            <td class="pro-thumbnail"><img class="img-fluid" src="<?= BASE_URL . $sp['hinh_anh'] ?>" alt="<?= $sp['ten_san_pham'] ?>" style="width: 80px;"></td>
                                            <td class="pro-title"><?= $sp['ten_san_pham'] ?></td>
                                            <td class="pro-price"><?= number_format($sp['gia'], 0, ',', '.') ?> đ</td>
                                            <td class="pro-quantity">
                                                <form action="<?= BASE_URL ?>?act=cap-nhat-so-luong" method="POST">
                                                    <input type="hidden" name="gio_hang_id" value="<?= $gioHangId ?>">
                                                    <input type="hidden" name="san_pham_id" value="<?= $sp['id'] ?>">
                                                    <input type="number" name="so_luong" value="<?= $sp['so_luong'] ?>" class="form-control" style="width:70px;">
                                                    <button class="form-control" type="submit" class="btn btn-sm btn-warning mt-1">Cập nhật</button>
                                                </form>
                                            </td>

                                            <td class="pro-subtotal"><?= number_format($sp['tong'], 0, ',', '.') ?> đ</td>
                                            <td class="pro-remove"><a href="<?= BASE_URL ?>?act=xoa-san-pham-gio&id=<?= $sp['id'] ?>"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php if (isset($_SESSION['cart_error_msg'])): ?>
                                        <div class="alert alert-danger mt-3">
                                            <?= $_SESSION['cart_error_msg'] ?>
                                        </div>
                                        <?php unset($_SESSION['cart_error_msg']);
                                        ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <!-- Cart Calculation Area -->
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Tổng tiền</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr class="total">
                                            <td class="total-amount"><?= number_format($tongTien, 0, ',', '.') ?> vnđ</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="cart-calculate-items">
                                <form action="<?= BASE_URL ?>?act=xac-nhan-thong-tin" method="POST">
                                    <button type="submit" class="btn btn-sqr d-block mt-3">Xác nhận thông tin</button>
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart main wrapper end -->
</main>

<?php include_once './views/layout/footer.php'; ?>