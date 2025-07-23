<?php
include_once './views/layout/header.php';
include_once './views/layout/navbar.php';
include_once './views/layout/sidebar.php';
date_default_timezone_set('Asia/Ho_Chi_Minh'); // Đặt múi giờ Việt Nam
$now = date('Y-m-d');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sửa Sản Phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="ten_san_pham">Tên sản phẩm</label>
                        <input type="text" value="<?= $sanPham['ten_san_pham'] ?>" class="form-control" name="ten_san_pham" placeholder="Nhập tên sản phẩm">
                        <?php if (isset($errors['ten_san_pham'])) { ?>
                            <p class="text-danger"><?= $errors['ten_san_pham'] ?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="hinh_anh">Hình ảnh</label>
                        <div class="mb-3">
                            <img id="previewImage"
                                src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                alt="Ảnh sản phẩm"
                                class="img-thumbnail"
                                style="max-width: 150px;"
                                onerror="this.onerror=null;this.src='https://www.studytienganh.vn/upload/2021/04/96746.png';">
                        </div>
                        <input type="file" class="form-control-file" name="hinh_anh" onchange="previewSelectedImage(this)">

                        <?php if (isset($errors['hinh_anh'])) { ?>
                            <p class="text-danger"><?= $errors['hinh_anh'] ?></p>
                        <?php } ?>
                    </div>


                    <div class="form-group">
                        <label for="hinh_anh">Ablum ảnh</label>
                        <input type="file" name="img_array[]" multiple="multiple" class="form-control" name="hinh_anh">
                    </div>
                    <div class="form-group">
                        <label for="gia_san_pham">Giá sản phẩm</label>
                        <input type="number" value="<?= number_format($sanPham['gia_san_pham']) ?>" class="form-control" name="gia_san_pham" placeholder="Nhập giá sản phẩm">
                        <?php if (isset($errors['gia_san_pham'])) { ?>
                            <p class="text-danger"><?= $errors['gia_san_pham'] ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="gia_khuyen_mai">Giá khuyến mãi</label>
                        <input type="number" value="<?= number_format($sanPham['gia_khuyen_mai']) ?>" class="form-control" name="gia_khuyen_mai" placeholder="Nhập giá khuyến mãi (nếu có)">
                    </div>
                    <div class="form-group">
                        <label for="so_luong">Số lượng</label>
                        <input type="number" value="<?= $sanPham['so_luong'] ?>" class="form-control" name="so_luong" placeholder="Nhập số lượng">
                        <?php if (isset($errors['so_luong'])) { ?>
                            <p class="text-danger"><?= $errors['so_luong'] ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Ngày nhập</label>
                        <input
                            type="date"
                            name="ngay_nhap"
                            class="form-control"
                            value="<?= $now ?>"
                            min="<?= $now ?>"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="mo_ta">Mô tả</label>
                        <textarea class="form-control" name="mo_ta" placeholder="Nhập mô tả sản phẩm"><?= $sanPham['mo_ta'] ?></textarea>
                    </div>


                    <div class="form-group">
                        <label for="danh_muc_id">Danh mục</label>
                        <select name="danh_muc_id" class="form-control">
                            <?php foreach ($danhMucList as $dm): ?>
                                <option value="<?= $dm['id'] ?>" <?= ($sanPham['danh_muc_id'] == $dm['id']) ? 'selected' : '' ?>>
                                    <?= $dm['ten_danh_muc'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['danh_muc_id'])) { ?>
                            <p class="text-danger"><?= $errors['danh_muc_id'] ?></p>
                        <?php } ?>
                    </div>


                    <div class="form-group">
                        <label for="trang_thai">Trạng thái</label>
                        <select name="trang_thai" class="form-control">
                            <option value="1" <?= $sanPham['trang_thai'] == 1 ? 'selected' : '' ?>>Còn hàng</option>
                            <option value="2" <?= $sanPham['trang_thai'] == 2 ? 'selected' : '' ?>>Hết hàng</option>
                        </select>
                        <?php if (isset($errors['trang_thai'])) { ?>
                            <p class="text-danger"><?= $errors['trang_thai'] ?></p>
                        <?php } ?>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                </div>
            </form>

        </div>

        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
// Include footer
include_once 'views/layout/footer.php';
?>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
</body>

</html>