<?php

namespace Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost'; 
    private $db_name = 'Train_management_system'; 
    private $username = 'root'; 
    private $password = 'root';  
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            // Create a new PDO instance
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Handle connection error
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>      