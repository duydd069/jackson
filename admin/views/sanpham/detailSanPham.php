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
      <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham'?>"> 
        <button class="btn btn-secondary">Chi tiết sản phẩm</button>
      </a>
      <hr>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Giá khuyến mãi</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listSanPham as $key => $sanPham): ?>
                    <tr>
                      <td><?php echo $sanPham['id'] ?></td>
                      <td><a href="<?php echo BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id=' . $sanPham['id'] ?>"><?php echo $sanPham['ten_san_pham'] ?></a></td>
                      <td><?php echo $sanPham['gia_san_pham'] ?></td>
                      <td><?php echo $sanPham['gia_khuyen_mai'] ?></td>
                      <td><?php echo $sanPham['so_luong'] ?></td>
                      <td><?php echo $sanPham['danh_muc_id'] ?></td>
                      <td>
                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-danh-muc&id=' . $danhMuc['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                        <a href="<?= BASE_URL_ADMIN . '?act=xoa-danh-muc&id=' . $danhMuc['id'] ?>"><button onclick=" return confirm('Bồ có chắc muốn xóa danh mục này không ?')" class="btn btn-danger">Xóa</button></a>
                      </td>
                    </tr>
                  <?php endforeach ?>

              </table>
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
</script>
</body>

</html>