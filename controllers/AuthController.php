<?php
class AdminAuthController
{
    public $modelTaiKhoan;

    // SỬA: __contract() thành __construct()
    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }

    public function formLogin()
    {
        require_once './views/login.php';
    }

    public function login()
    {
        $email = $_POST['email'];
        $mat_khau = $_POST['mat_khau'];

        // Tìm tài khoản theo email
        $taiKhoan = $this->modelTaiKhoan->getTaiKhoanByEmail($email);

        // Kiểm tra user tồn tại và mật khẩu đúng
        if ($taiKhoan && $mat_khau === $taiKhoan['mat_khau']) {

            // Phân quyền theo chuc_vu_id
            if ($taiKhoan['chuc_vu_id'] == 1) {
                // Admin - vào trang admin
                $_SESSION['admin'] = $taiKhoan;
                $_SESSION['user_role'] = 'admin';
                header('Location: ' . BASE_URL_ADMIN);
            } else {
                // User thường - vào trang chủ
                $_SESSION['user'] = $taiKhoan;
                $_SESSION['user_role'] = 'user';
                header('Location: ' . BASE_URL);
            }
            exit;
        } else {
            $_SESSION['login_error'] = "Email hoặc mật khẩu sai!";
            header('Location: ' . BASE_URL . '?act=form-login');
            exit;
        }
    }

    public function formRegister()
    {
        require_once './views/register.php';
    }

    public function register()
    {
        $ho_ten = $_POST['ho_ten'];
        $email = $_POST['email'];
        $mat_khau = $_POST['mat_khau'];
        $mat_khau2 = $_POST['mat_khau2'];

        if ($mat_khau !== $mat_khau2) {
            $_SESSION['register_error'] = "Mật khẩu nhập lại không khớp!";
            header("Location: ?act=form-register");
            exit;
        }

        if ($this->modelTaiKhoan->getTaiKhoanByEmail($email)) {
            $_SESSION['register_error'] = "Email đã được sử dụng!";
            header("Location: ?act=form-register");
            exit;
        }

        // Không mã hóa mật khẩu
        $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $mat_khau);

        $_SESSION['success'] = "Đăng ký thành công, mời đăng nhập!";
        header("Location: ?act=form-login");
        exit;
    }



    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }
}
