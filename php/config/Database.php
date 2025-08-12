<?php
class Database {
    private $host = 'localhost';
    private $username = 'root'; // default for XAMPP
    private $password = 'your_password';     // default is empty
    private $database = 'printer'; // <-- Replace this

    private $conn;

    // Constructor - establish connection on object creation
    public function __construct() {
        $this->connect();
    }

    // Connect to the MySQL database
    private function connect() {
        $this->conn = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($this->conn->connect_error) {
            die("❌ Connection failed: " . $this->conn->connect_error);
        }
    }
     public function getConnection() {
        return $this->conn;
    }
}        
