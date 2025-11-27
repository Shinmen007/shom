<?php

namespace App\Models;

use App\Config\Database;
use PDO;

class Quiz {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function getQuestionsByCourseId($courseId) {
        // Try to get from database first
        $stmt = $this->db->prepare("SELECT * FROM quiz_questions WHERE course_id = :course_id ORDER BY id");
        $stmt->execute(['course_id' => $courseId]);
        $dbQuestions = $stmt->fetchAll();
        
        if (!empty($dbQuestions)) {
            $questions = [];
            foreach ($dbQuestions as $q) {
                $questions[] = [
                    'id' => $q['id'],
                    'question' => $q['question'],
                    'type' => $q['question_type'],
                    'options' => json_decode($q['options'], true),
                    'answer' => (int)$q['correct_answer'],
                    'explanation' => $q['explanation'] ?? ''
                ];
            }
            return $questions;
        }
        
        // Fallback to hardcoded for MVP if DB is empty
        return $this->getHardcodedQuestions($courseId);
    }

    private function getHardcodedQuestions($courseId) {
        if ($courseId == 1) { // Python
            return [
                ['id' => 1, 'question' => 'What is the output of print(2 + 2)?', 'options' => ['3', '4', '22', 'Error'], 'answer' => 1, 'explanation' => '2 + 2 equals 4'],
                ['id' => 2, 'question' => 'Which keyword is used to define a function in Python?', 'options' => ['func', 'def', 'function', 'define'], 'answer' => 1, 'explanation' => 'In Python, functions are defined using "def"'],
                ['id' => 3, 'question' => 'What data type is "Hello"?', 'options' => ['Integer', 'Float', 'String', 'Boolean'], 'answer' => 2, 'explanation' => 'Text in quotes is a String'],
                ['id' => 4, 'question' => 'How do you start a comment in Python?', 'options' => ['//', '/*', '#', '<!--'], 'answer' => 2, 'explanation' => 'Python uses # for single-line comments'],
                ['id' => 5, 'question' => 'Which of these is a list?', 'options' => ['(1, 2)', '{1, 2}', '[1, 2]', '<1, 2>'], 'answer' => 2, 'explanation' => 'Lists use square brackets []'],
            ];
        } else { // JS
            return [
                ['id' => 1, 'question' => 'Which keyword creates a constant variable?', 'options' => ['var', 'let', 'const', 'fixed'], 'answer' => 2, 'explanation' => 'const creates a constant that cannot be reassigned'],
                ['id' => 2, 'question' => 'What is console.log() used for?', 'options' => ['Input', 'Output', 'Looping', 'Styling'], 'answer' => 1, 'explanation' => 'console.log() outputs messages to the console'],
                ['id' => 3, 'question' => 'Which symbol is used for strict equality?', 'options' => ['=', '==', '===', '!=='], 'answer' => 2, 'explanation' => '=== checks both value and type'],
                ['id' => 4, 'question' => 'How do you write a function?', 'options' => ['function myFunc()', 'def myFunc()', 'func myFunc()', 'create myFunc()'], 'answer' => 0, 'explanation' => 'JavaScript uses the "function" keyword'],
                ['id' => 5, 'question' => 'What is an array?', 'options' => ['Object', 'List of values', 'String', 'Number'], 'answer' => 1, 'explanation' => 'Arrays store ordered lists of values'],
            ];
        }
    }

    public function saveResult($userId, $courseId, $score, $total = 10, $answers = null, $timeTaken = 0) {
        $stmt = $this->db->prepare("INSERT INTO quiz_results (user_id, course_id, score, total_questions, answers_json, time_taken_seconds) VALUES (:user_id, :course_id, :score, :total, :answers, :time)");
        return $stmt->execute([
            'user_id' => $userId,
            'course_id' => $courseId,
            'score' => $score,
            'total' => $total,
            'answers' => $answers ? json_encode($answers) : null,
            'time' => $timeTaken
        ]);
    }

    public function getBestScore($userId, $courseId) {
        $stmt = $this->db->prepare("SELECT MAX(score) as best_score FROM quiz_results WHERE user_id = :user_id AND course_id = :course_id");
        $stmt->execute(['user_id' => $userId, 'course_id' => $courseId]);
        return $stmt->fetchColumn();
    }

    public function getRecentAttempts($userId, $courseId, $limit = 5) {
        $stmt = $this->db->prepare("SELECT * FROM quiz_results WHERE user_id = :user_id AND course_id = :course_id ORDER BY submitted_at DESC LIMIT :limit");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':course_id', $courseId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserStats($userId) {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(*) as total_attempts,
                AVG(score) as avg_score,
                MAX(score) as best_score,
                SUM(time_taken_seconds) as total_time
            FROM quiz_results 
            WHERE user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }
}
