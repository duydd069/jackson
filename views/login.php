<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Đăng nhập</h2>
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="alert alert-danger">
                <?= $_SESSION['login_error'] ?>
            </div>
            <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>
        <form method="POST" action="?act=login">
            <div>
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Mật khẩu:</label>
                <input type="password" name="mat_khau" required>
            </div>
            <button type="submit">Đăng nhập</button>

            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error"><?= $_SESSION['login_error'] ?></div>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>
        </form>
    </div>

</body>

</html>