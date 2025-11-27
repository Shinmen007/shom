<?php

namespace App\Controllers;

use App\Config\Database;
use PDO;

class AuthController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                // Ideally pass error to view
                echo "All fields are required"; 
                return;
            }

            // Check if user exists
            $stmt = $this->db->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                echo "Email already registered";
                return;
            }

            // Create user
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :hash)");
            
            try {
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'hash' => $hash
                ]);
                
                // Auto login or redirect
                header('Location: /login');
                exit;
            } catch (\Exception $e) {
                echo "Registration failed";
            }
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password_hash'])) {
                // Start session
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                
                header('Location: /dashboard');
                exit;
            } else {
                echo "Invalid credentials";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
        exit;
    }
}
