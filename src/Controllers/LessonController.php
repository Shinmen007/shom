<?php

namespace App\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use App\Services\ProgressService;

class LessonController {
    
    public function index($courseId) {
        $lessonModel = new Lesson();
        $courseModel = new Course();
        
        $course = $courseModel->getById($courseId);
        $lessons = $lessonModel->getByCourseId($courseId);
        
        // Get user progress if logged in
        $progress = [];
        if (isset($_SESSION['user_id'])) {
            $progress = $lessonModel->getProgress($_SESSION['user_id'], $courseId);
        }

        view('course_overview', ['course' => $course, 'lessons' => $lessons, 'progress' => $progress]);
    }

    public function show($lessonId) {
        $lessonModel = new Lesson();
        $lesson = $lessonModel->getById($lessonId);
        
        if (!$lesson) {
            echo "Lesson not found";
            return;
        }

        $exercise = $lessonModel->getExerciseByLessonId($lessonId);
        
        // Get course for navigation
        $courseModel = new Course();
        $course = $courseModel->getById($lesson['course_id']);
        $allLessons = $lessonModel->getByCourseId($lesson['course_id']);
        
        // Find previous/next lessons
        $prevLesson = null;
        $nextLesson = null;
        $currentIndex = 0;
        foreach ($allLessons as $index => $l) {
            if ($l['id'] == $lessonId) {
                $currentIndex = $index;
                if ($index > 0) {
                    $prevLesson = $allLessons[$index - 1];
                }
                if ($index < count($allLessons) - 1) {
                    $nextLesson = $allLessons[$index + 1];
                }
                break;
            }
        }
        
        // Check if lesson is already completed
        $isCompleted = false;
        if (isset($_SESSION['user_id'])) {
            $progress = $lessonModel->getProgress($_SESSION['user_id'], $lesson['course_id']);
            $isCompleted = isset($progress[$lessonId]) && $progress[$lessonId];
        }
        
        view('lesson', [
            'lesson' => $lesson, 
            'exercise' => $exercise,
            'course' => $course,
            'prevLesson' => $prevLesson,
            'nextLesson' => $nextLesson,
            'totalLessons' => count($allLessons),
            'currentIndex' => $currentIndex + 1,
            'isCompleted' => $isCompleted
        ]);
    }

    public function complete($lessonId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $lessonModel = new Lesson();
            $userId = $_SESSION['user_id'];
            
            // Check if already completed to avoid duplicate XP
            $currentLesson = $lessonModel->getById($lessonId);
            $progress = $lessonModel->getProgress($userId, $currentLesson['course_id']);
            $alreadyCompleted = isset($progress[$lessonId]) && $progress[$lessonId];
            
            // Mark lesson complete
            $lessonModel->markComplete($userId, $lessonId);
            
            // Record activity and award XP only if not already completed
            if (!$alreadyCompleted) {
                $progressService = new ProgressService();
                $xpEarned = 50; // Base XP per lesson
                $timeSpent = 300; // Estimate 5 minutes per lesson
                $progressService->recordActivity($userId, 'lesson', $xpEarned, $timeSpent);
            }
            
            // Find next lesson or redirect to course
            $allLessons = $lessonModel->getByCourseId($currentLesson['course_id']);
            
            $nextLessonId = null;
            $foundCurrent = false;
            foreach ($allLessons as $l) {
                if ($foundCurrent) {
                    $nextLessonId = $l['id'];
                    break;
                }
                if ($l['id'] == $lessonId) {
                    $foundCurrent = true;
                }
            }

            if ($nextLessonId) {
                header("Location: /lesson/$nextLessonId");
            } else {
                // Course completed - redirect to quiz
                header("Location: /course/" . $currentLesson['course_id'] . "/quiz");
            }
            exit;
        }
    }
}
