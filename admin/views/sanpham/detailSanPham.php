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
        <div class="col-sm-6">
          <h1>Sản Phẩm</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
<div class="card-body">
        <table class="table table-bordered">
          <tr>
            <th>ID</th>
            <td><?= $sanPham['id'] ?></td>
          </tr>
          <tr>
            <th>Tên sản phẩm</th>
            <td><?= $sanPham['ten_san_pham'] ?></td>
          </tr>
          <tr>
            <th>Giá sản phẩm</th>
            <td><?= number_format($sanPham['gia_san_pham']) ?> đ</td>
          </tr>
          <tr>
            <th>Giá khuyến mãi</th>
            <td><?= number_format($sanPham['gia_khuyen_mai']) ?> đ</td>
          </tr>
          <tr>
            <th>Số lượng</th>
            <td><?= $sanPham['so_luong'] ?></td>
          </tr>
          <tr>
            <th>Danh mục</th>
            <td><?= $sanPham['ten_danh_muc'] ?></td>
          </tr>
          <tr>
            <th>Ngày nhập</th>
            <td><?= date('d/m/Y', strtotime($sanPham['ngay_nhap'])) ?></td>
          </tr>
          <tr>
  <th>Mô tả</th>
  <td>
    <div id="moTaShort">
      <?= nl2br(substr($sanPham['mo_ta'], 0, 100)) ?>
      <?php if (strlen($sanPham['mo_ta']) > 100): ?>
        ... <a href="javascript:void(0);" onclick="showFullMoTa()">Xem thêm</a>
      <?php endif; ?>
    </div>
    <div id="moTaFull" style="display: none;">
      <?= nl2br($sanPham['mo_ta']) ?>
      <br><a href="javascript:void(0);" onclick="hideFullMoTa()">Ẩn bớt</a>
    </div>
  </td>
</tr>

        </table>
        <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="btn btn-secondary mt-3">Quay lại</a>
      </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
    function showFullMoTa() {
    document.getElementById('moTaShort').style.display = 'none';
    document.getElementById('moTaFull').style.display = 'block';
  }

  function hideFullMoTa() {
    document.getElementById('moTaFull').style.display = 'none';
    document.getElementById('moTaShort').style.display = 'block';
  }
</script>
</body>

</html>