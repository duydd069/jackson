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
          <h1>Danh Mục</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <a href="<?= BASE_URL_ADMIN . '?act=form-them-danh-muc'?>"> 
        <button class="btn btn-secondary">Thêm danh mục</button>
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
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listDanhMuc as $key => $danhMuc): ?>
                    <tr>
                      <td><?php echo $danhMuc['id'] ?></td>
                      <td><?php echo $danhMuc['ten_danh_muc'] ?></td>
                      <td><?php echo $danhMuc['mo_ta'] ?></td>
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