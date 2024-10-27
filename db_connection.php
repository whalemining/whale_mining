<?php
class Database {
    private $host = 'localhost'; // Database host
    private $db_name = 'u132187744_whale'; // Database name
    private $username = 'u132187744_whale'; // Database username
    private $password = 'Mustbeadmin@1'; // Database password
    private $conn; // Connection property

    // Method to establish a connection to the database
    public function connect() {
        $this->conn = null; // Initialize connection as null

        try {
            // Use PDO for a secure connection
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username,
                $this->password
            );
            // Set error mode to throw exceptions for any issues
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Ensure proper UTF-8 encoding
            $this->conn->exec("SET NAMES utf8");
        } catch (PDOException $e) {
            // If connection fails, output error
            echo json_encode(['status' => 'error', 'message' => 'Connection Error: ' . $e->getMessage()]);
            exit(); // Stop further execution
        }

        return $this->conn; // Return the database connection
    }
}
?>
