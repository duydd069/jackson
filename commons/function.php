<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Hàm kiểm tra đăng nhập admin
function checkAdminLogin() {
    if (!isset($_SESSION['admin']) || $_SESSION['user_role'] !== 'admin') {
        $_SESSION['login_error'] = "Bạn cần đăng nhập với quyền admin!";
        header('Location: ' . BASE_URL . '?act=form-login');
        exit;
    }
}

// Hàm kiểm tra đăng nhập user
function checkUserLogin() {
    if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])) {
        $_SESSION['login_error'] = "Bạn cần đăng nhập!";
        header('Location: ' . BASE_URL . '?act=form-login');
        exit;
    }
}

// Hàm kiểm tra chỉ user thường (không phải admin)
function checkOnlyUser() {
    if (!isset($_SESSION['user']) || $_SESSION['user_role'] !== 'user') {
        $_SESSION['login_error'] = "Trang này chỉ dành cho user!";
        header('Location: ' . BASE_URL);
        exit;
    }
}

// Hàm lấy thông tin user hiện tại
function getCurrentUser() {
    if (isset($_SESSION['admin'])) {
        return $_SESSION['admin'];
    } elseif (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return null;
}

// Hàm kiểm tra quyền
function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['user_role'] === 'admin';
}

function isUser() {
    return isset($_SESSION['user']) && $_SESSION['user_role'] === 'user';
}

function isLoggedIn() {
    return isset($_SESSION['admin']) || isset($_SESSION['user']);
}
 
//Thêm file
function uploadFile($file, $folderUpdload) {
    $pathStorage = $folderUpdload . time() . $file['name'];

    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;
    
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }
    return null;
}
// Xóa file
function deleteFile($file) {
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}
// Debug
