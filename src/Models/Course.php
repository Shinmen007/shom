<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Course {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM courses ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM courses WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Helper for seeding/testing
    public function create($title, $description, $language, $difficulty = 'Beginner') {
        $stmt = $this->db->prepare("INSERT INTO courses (title, description, language, difficulty) VALUES (:title, :description, :language, :difficulty)");
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'language' => $language,
            'difficulty' => $difficulty
        ]);
        return $this->db->lastInsertId();
    }
}
