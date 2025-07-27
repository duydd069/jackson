<?php include_once './views/layout/header.php'; ?>
<?php include_once './views/layout/navbar.php'; ?>
<?php include_once './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Danh sách người dùng</h1>
    </section>

    <section class="content">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['ho_ten'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <?= $user['trang_thai'] == 1 ? 'Đang hoạt động' : 'Bị khóa' ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL_ADMIN . '?act=ban-user&id=' . $user['id'] ?>" class="btn btn-<?= $user['trang_thai'] == 1 ? 'danger' : 'success' ?> btn-sm">
                                <?= $user['trang_thai'] == 1 ? 'Ban' : 'Mở ban' ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>

<?php include_once './views/layout/footer.php'; ?>
