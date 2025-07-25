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
                    <h1>Chi tiết đơn hàng</h1>
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
                                    <td><?= $donHang['id'] ?></td>
                                </tr>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <td><?= $donHang['ma_don_hang'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tài khoản</th>
                                    <td><?= $donHang['tai_khoan_id'] ?></td>
                                </tr>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <td><?= $donHang['ma_don_hang'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tên người nhân</th>
                                    <td><?= $donHang['ten_nguoi_nhan'] ?> </td>
                                </tr>
                                <tr>
                                    <th>Email người nhận</th>
                                    <td><?= $donHang['email_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại người nhận</th>
                                    <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <td><?= $donHang['dia_chi_nguoi_nhan'] ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày đặt</th>
                                    <td><?= $donHang['ngay_dat'] ?></td>
                                </tr>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <td><?= $donHang['tong_tien'] ?>VND</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td><?= $donHang['ghi_chu'] ?></td>
                                </tr>
                                <tr>
                                    <th>Phương thức thanh toán</th>
                                    <td><?= $donHang['ten_phuong_thuc'] ?></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td><?= $donHang['ten_trang_thai'] ?></td>
                                </tr>

                            </table>
                            <a href="<?= BASE_URL_ADMIN . '?act=don-hang' ?>" class="btn btn-secondary mt-3">Quay lại</a>
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