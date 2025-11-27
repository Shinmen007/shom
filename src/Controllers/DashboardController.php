<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Services\ProgressService;
use App\Config\Database;
use PDO;

class DashboardController {
    
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $courseModel = new Course();
        $lessonModel = new Lesson();
        $progressService = new ProgressService();

        // Get comprehensive stats
        $stats = $progressService->getComprehensiveStats($userId);
        $weeklyActivity = $progressService->getWeeklyActivity($userId);

        // Get all courses and user progress
        $courses = $courseModel->getAll();
        $userProgress = [];

        foreach ($courses as $course) {
            $lessons = $lessonModel->getByCourseId($course['id']);
            $totalLessons = count($lessons);
            
            $completed = $lessonModel->getProgress($userId, $course['id']);
            $completedCount = 0;
            foreach ($completed as $lessonId => $isComplete) {
                if ($isComplete) $completedCount++;
            }

            $percentage = $totalLessons > 0 ? round(($completedCount / $totalLessons) * 100) : 0;

            $userProgress[] = [
                'course' => $course,
                'total_lessons' => $totalLessons,
                'completed_lessons' => $completedCount,
                'percentage' => $percentage
            ];
        }

        view('dashboard', [
            'progressData' => $userProgress,
            'stats' => $stats,
            'weeklyActivity' => $weeklyActivity
        ]);
    }
}
