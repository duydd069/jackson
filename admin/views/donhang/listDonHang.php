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
                    <h1>Đơn hàng</h1>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>SDT</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listDonHang as $key => $donHang): ?>
                                        <tr>
                                            <td><?php echo $donHang['ma_don_hang']; ?></td>
                                            <td><Strong><a href="<?php echo BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id=' . $donHang['id'] ?>"><?php echo $donHang['ma_don_hang'] ?></a></Strong></td>
                                            <td><?php echo $donHang['ten_nguoi_nhan'] ?></td>
                                            <td><?php echo $donHang['sdt_nguoi_nhan'] ?></td>
                                            <td><?php echo $donHang['ngay_dat'] ?></td>
                                            <td><?php echo $donHang['tong_tien'] ?></td>
                                            <td><?php echo $donHang['ten_trang_thai'] ?></td>
                                            <td>
                                                <a href="<?= BASE_URL_ADMIN . '?act=detail-don-hang&id=' . $donHang['id'] ?>"><button class="btn btn-info">Chi tiết</button></a>
                                                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id=' . $donHang['id'] ?>"><button class="btn btn-primary">Sửa</button></a>
                                                <a href="<?= BASE_URL_ADMIN . '?act=xoa-don-hang&id=' . $donHang['id'] ?>"><button onclick=" return confirm('Bồ có chắc muốn xóa danh mục này không ?')" class="btn btn-danger">Xóa</button></a>
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