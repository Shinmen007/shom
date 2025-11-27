<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Lesson {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getByCourseId($courseId) {
        $stmt = $this->db->prepare("SELECT * FROM lessons WHERE course_id = :course_id ORDER BY lesson_order ASC");
        $stmt->execute(['course_id' => $courseId]);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM lessons WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function getExerciseByLessonId($lessonId) {
        $stmt = $this->db->prepare("SELECT * FROM exercises WHERE lesson_id = :lesson_id LIMIT 1");
        $stmt->execute(['lesson_id' => $lessonId]);
        return $stmt->fetch();
    }

    public function create($courseId, $title, $content, $order) {
        $stmt = $this->db->prepare("INSERT INTO lessons (course_id, title, content, lesson_order) VALUES (:course_id, :title, :content, :lesson_order)");
        $stmt->execute([
            'course_id' => $courseId,
            'title' => $title,
            'content' => $content,
            'lesson_order' => $order
        ]);
        return $this->db->lastInsertId();
    }

    public function createExercise($lessonId, $instructions, $starterCode, $expectedOutput) {
        $stmt = $this->db->prepare("INSERT INTO exercises (lesson_id, instructions, starter_code, expected_output) VALUES (:lesson_id, :instructions, :starter_code, :expected_output)");
        return $stmt->execute([
            'lesson_id' => $lessonId,
            'instructions' => $instructions,
            'starter_code' => $starterCode,
            'expected_output' => $expectedOutput
        ]);
    }

    public function markComplete($userId, $lessonId) {
        // check if already exists
        $stmt = $this->db->prepare("SELECT id FROM user_progress WHERE user_id = :user_id AND lesson_id = :lesson_id");
        $stmt->execute(['user_id' => $userId, 'lesson_id' => $lessonId]);
        
        if (!$stmt->fetch()) {
            $stmt = $this->db->prepare("INSERT INTO user_progress (user_id, lesson_id, completed, completed_at) VALUES (:user_id, :lesson_id, 1, CURRENT_TIMESTAMP)");
            return $stmt->execute(['user_id' => $userId, 'lesson_id' => $lessonId]);
        }
        return true;
    }

    public function getProgress($userId, $courseId) {
        $sql = "SELECT l.id, up.completed 
                FROM lessons l 
                LEFT JOIN user_progress up ON l.id = up.lesson_id AND up.user_id = :user_id 
                WHERE l.course_id = :course_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId, 'course_id' => $courseId]);
        return $stmt->fetchAll(PDO::FETCH_KEY_PAIR); // Returns [lesson_id => completed]
    }
}
