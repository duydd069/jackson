<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Đăng nhập</h3>

                        <?php if (isset($_SESSION['login_error'])): ?>
                            <div class="alert alert-danger">
                                <?= $_SESSION['login_error'] ?>
                            </div>
                            <?php unset($_SESSION['login_error']); ?>
                        <?php endif; ?>

                        <form method="POST" action="?act=login">
                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập email" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mật khẩu:</label>
                                <input type="password" name="mat_khau" class="form-control" placeholder="Nhập mật khẩu" >
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3 text-muted">© <?= date('Y') ?> Jackson Project</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle (có Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
