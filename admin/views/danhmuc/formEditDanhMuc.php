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
                    <h1>Sửa Danh Mục</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <!-- /.card-header -->
            <!-- form start -->
            <form action="<?= BASE_URL_ADMIN . '?act=sua-danh-muc'?>" method="POST">
                <input type="hidden" name="id" value="<?= $danhMuc['id']?>">
                <div class="card-body">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input type="text" class="form-control" name="ten_danh_muc" value="<?= $danhMuc['ten_danh_muc']?>" placeholder="Nhập tên danh mục">
                        <?php if (isset($errors['ten_danh_muc'])) { ?>
                            <p class="text-danger"><?= $errors['ten_danh_muc']?></p>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="mo_ta"  placeholder="Nhập mô tả">
<?= $danhMuc['mo_ta']?>
</textarea>
                        
                    </div>
                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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