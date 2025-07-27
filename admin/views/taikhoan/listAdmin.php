<?php include_once './views/layout/header.php'; ?>
<?php include_once './views/layout/navbar.php'; ?>
<?php include_once './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Danh sách quản trị viên</h1>
    </section>

    <section class="content">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($admins as $admin): ?>
                    <tr>
                        <td><?= $admin['id'] ?></td>
                        <td><?= $admin['ho_ten'] ?></td>
                        <td><?= $admin['email'] ?></td>
                        <td><?= $admin['chuc_vu_id'] == 1 ? 'Admin' : 'User' ?></td>
                        <td>
                            <?php if ($_SESSION['admin']['id'] == 1 && $admin['id'] != 1): ?>
                                <a href="<?= BASE_URL_ADMIN . '?act=xoa-quyen-admin&id=' . $admin['id'] ?>" class="btn btn-warning btn-sm">Xóa quyền Admin</a>
                            <?php else: ?>
                                <span class="text-muted">Không thể thao tác</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>

<?php include_once './views/layout/footer.php'; ?>
