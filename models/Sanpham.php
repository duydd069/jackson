<?php
class SanPham {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllProducts() {
        try{
            $sql = "SELECT * FROM san_phams";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

}
