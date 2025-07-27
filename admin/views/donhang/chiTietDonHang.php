<?php
include_once './views/layout/header.php';
include_once './views/layout/navbar.php';
include_once './views/layout/sidebar.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h1>Quản lý danh sách - Đơn hàng : <?= $donHang['ma_don_hang'] ?></h1>
                </div>
                <div class="col-sm-2">
                  <form action="" method="post">
                    <select name="" id="" class="form-group">
                      <?php foreach ($listTrangThaiDonHang as $key=> $trangThai): ?>
                        <option 
                        <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?> 
                        <?= $trangThai['id'] < $donHang['trang_thai_id'] ? 'disabled' : '' ?> 
                        value="<?= $trangThai['id'] ?>" 
                        <?= $donHang['trang_thai_id'] == $trangThai['id'] ? 'selected' : '' ?>>
                            <?= $trangThai['ten_trang_thai'] ?>
                        </option>
                      <?php endforeach ?>

                    </select>
                  </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php 
                if ($donHang['trang_thai_id'] == 1) {
                    $colorAlerts = 'warning';
                } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                    $colorAlerts = 'primary';
                } elseif ($donHang['trang_thai_id'] == 10) {
                    $colorAlerts = 'success';
                }
                else {
                    $colorAlerts = 'danger';
                }
            ?>
                <div class="alert alert-<?= $colorAlerts ?>" role="alert">
  Đơn hàng : <strong><?= $donHang['ten_trang_thai'] ?></strong>
</div>



            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> Jackson Shop
                    <small class="float-right">Ngày đặt:<?= $donHang['ngay_dat'] ?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Thông tin người đặt
                  <address>
                    <strong><?= $donHang['ho_ten']?></strong><br>
                    Email: <?= $donHang['email'] ?><br>
                    Số điện thoại : <?= $donHang['so_dien_thoai'] ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Người nhận
                  <address>
                    <strong><?= $donHang['ten_nguoi_nhan']?></strong><br>
                    Email: <?= $donHang['email_nguoi_nhan'] ?><br>
                    Số điện thoại : <?= $donHang['sdt_nguoi_nhan'] ?><br>
                    Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Thông tin
                  <address>
                    <strong>Mã đơn hàng<?= $donHang['ma_don_hang']?></strong><br>
                    Phương thức thanh toán: <?= $donHang['ten_phuong_thuc'] ?><br>
                    Số điện thoại : <?= $donHang['sdt_nguoi_nhan'] ?><br>
                    Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <td>#</td>
                      <td>Tên sản phẩm</td>
                      <td>Đơn giá</td>
                      <td>Số lượng</td>
                      <td>Thành tiền</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($sanPhamDonHang as $key => $sanPham): ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $sanPham['ten_san_pham'] ?></td>
                      <td><?= number_format($sanPham['don_gia']) ?> đ</td>
                      <td><?= $sanPham['so_luong'] ?></td>
                      <td><?= number_format($sanPham['don_gia'] * $sanPham['so_luong']) ?> đ</td>
                    </tr>
                    <?php endforeach; ?>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->

                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Ngày đặt <?= $donHang['ngay_dat'] ?></p>

                  <div class="table-responsive">
                    <table class="table">

                      <tr>
                        <th>Tổng tiền</th>
                        <td><?= number_format($donHang['tong_tien'] ) ?> đ</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->


            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
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