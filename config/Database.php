<?php
class Database {
    private $host = "localhost";
    private $db_name = "db_triologic";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            
            error_log("Database connection failure: " . $exception->getMessage());
            die("Sistem sedang mengalami gangguan koneksi database. Silakan coba beberapa saat lagi.");
        }
        return $this->conn;
    }
}
?>
