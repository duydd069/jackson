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
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
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
    public function taiKhoan()
    {
        if (empty($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?act=form-login");
            exit;
        }
        $uid  = (int)$_SESSION['user']['id'];
        $user = $this->modelTaiKhoan->getUserById($uid);
        $listCategory = $this->modelTaiKhoan->getAllCategories();

        $success = $_SESSION['flash_success'] ?? null;
        $error   = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_success'], $_SESSION['flash_error']);

        require './views/taiKhoan.php';
    }

    public function capNhatThongTin()
    {
        if (empty($_SESSION['user'])) {
            header("Location: " . BASE_URL . "?act=form-login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE_URL . "?act=tai-khoan");
            exit;
        }

        $uid = (int)$_SESSION['user']['id'];

        // Lấy dữ liệu form
        $ho_ten        = trim($_POST['ho_ten'] ?? '');
        $email         = trim($_POST['email'] ?? '');
        $so_dien_thoai = trim($_POST['so_dien_thoai'] ?? '');
        $ngay_sinh     = trim($_POST['ngay_sinh'] ?? '');
        $gioi_tinh     = $_POST['gioi_tinh'] ?? null; // 'nam' | 'nu' | 'khac' (đúng theo DB jackson.sql)
        $dia_chi       = trim($_POST['dia_chi'] ?? '');
        $mat_khau      = trim($_POST['mat_khau'] ?? '');
        $xac_nhan_mk   = trim($_POST['xac_nhan_mat_khau'] ?? '');

        if ($email === '' || $ho_ten === '') {
            $_SESSION['flash_error'] = 'Vui lòng nhập Họ tên và Email.';
            header("Location: " . BASE_URL . "?act=tai-khoan");
            exit;
        }
        if ($this->modelTaiKhoan->emailExistsOther($email, $uid)) {
            $_SESSION['flash_error'] = 'Email đã được sử dụng bởi tài khoản khác.';
            header("Location: " . BASE_URL . "?act=tai-khoan");
            exit;
        }
        if ($mat_khau !== '' && $mat_khau !== $xac_nhan_mk) {
            $_SESSION['flash_error'] = 'Xác nhận mật khẩu không khớp.';
            header("Location: " . BASE_URL . "?act=tai-khoan");
            exit;
        }

        // Upload ảnh (tuỳ chọn)
        $anh_dai_dien = null;
        if (!empty($_FILES['anh_dai_dien']) && $_FILES['anh_dai_dien']['error'] === UPLOAD_ERR_OK) {
            $tmp  = $_FILES['anh_dai_dien']['tmp_name'];
            $name = $_FILES['anh_dai_dien']['name'];
            $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $_SESSION['flash_error'] = 'Ảnh phải là jpg, jpeg, png hoặc webp.';
                header("Location: " . BASE_URL . "?act=tai-khoan");
                exit;
            }
            if (!is_dir('./uploads/avatars')) @mkdir('./uploads/avatars', 0777, true);
            $newName = 'avt_' . $uid . '_' . time() . '.' . $ext;
            $destRel = 'uploads/avatars/' . $newName;
            if (!move_uploaded_file($tmp, './' . $destRel)) {
                $_SESSION['flash_error'] = 'Tải ảnh thất bại, thử lại.';
                header("Location: " . BASE_URL . "?act=tai-khoan");
                exit;
            }
            $anh_dai_dien = $destRel;
        }

        $data = [
            'ho_ten'        => $ho_ten,
            'email'         => $email,
            'so_dien_thoai' => $so_dien_thoai,
            'ngay_sinh'     => $ngay_sinh ?: null,
            'gioi_tinh'     => $gioi_tinh,
            'dia_chi'       => $dia_chi,
        ];
        if ($anh_dai_dien) $data['anh_dai_dien'] = $anh_dai_dien;
        if ($mat_khau !== '') $data['mat_khau'] = $mat_khau; // theo yêu cầu: không hash

        $ok = $this->modelTaiKhoan->updateUserProfile($uid, $data);
        if (!$ok) {
            $_SESSION['flash_error'] = 'Cập nhật thất bại.';
            header("Location: " . BASE_URL . "?act=tai-khoan");
            exit;
        }

        // Refresh session
        $fresh = $this->modelTaiKhoan->getUserById($uid);
        if ($fresh) $_SESSION['user'] = array_merge($_SESSION['user'], $fresh);

        $_SESSION['flash_success'] = 'Cập nhật thành công!';
        header("Location: " . BASE_URL . "?act=tai-khoan");
        exit;
    }
}
