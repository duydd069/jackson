<?php 
class AdminTaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }


    public function getTaiKhoanByEmail($email) { 
    $sql = "SELECT * FROM tai_khoans WHERE email = :email"; 
    $stmt = $this->conn->prepare($sql); 
    $stmt->execute([':email' => $email]); 
    return $stmt->fetch(); 
}
}