<?php

namespace App\Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'skill_orbit';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            // Check if we are using SQLite (file based) or MySQL
            // For this MVP environment, we default to SQLite if MySQL env vars aren't set
            if (getenv('DB_CONNECTION') === 'mysql') {
                $this->host = getenv('DB_HOST') ?: $this->host;
                $this->db_name = getenv('DB_DATABASE') ?: $this->db_name;
                $this->username = getenv('DB_USERNAME') ?: $this->username;
                $this->password = getenv('DB_PASSWORD') ?: $this->password;
                
                $this->conn = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password
                );
            } else {
                // Default to SQLite for easy setup
                $dbPath = __DIR__ . '/../../database/database.sqlite';
                $this->conn = new PDO("sqlite:" . $dbPath);
            }

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
