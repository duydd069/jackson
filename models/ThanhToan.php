<?php 
class ThanhToanModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    
}
?>