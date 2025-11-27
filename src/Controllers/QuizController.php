<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\Course;
use App\Services\ProgressService;

class QuizController {
    
    public function show($courseId) {
        $quizModel = new Quiz();
        $courseModel = new Course();
        
        $course = $courseModel->getById($courseId);
        $questions = $quizModel->getQuestionsByCourseId($courseId);
        
        view('quiz', ['course' => $course, 'questions' => $questions]);
    }

    public function submit($courseId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
            $quizModel = new Quiz();
            $questions = $quizModel->getQuestionsByCourseId($courseId);
            
            $score = 0;
            $total = count($questions);
            $answers = [];
            
            foreach ($questions as $q) {
                $userAnswer = $_POST['q' . $q['id']] ?? -1;
                $isCorrect = (int)$userAnswer === $q['answer'];
                if ($isCorrect) {
                    $score++;
                }
                $answers[$q['id']] = [
                    'selected' => (int)$userAnswer,
                    'correct' => $q['answer'],
                    'is_correct' => $isCorrect
                ];
            }
            
            // Calculate percentage
            $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
            
            // Get time taken from form
            $timeTaken = isset($_POST['time_taken']) ? (int)$_POST['time_taken'] : 0;
            
            // Save result with extended data
            $quizModel->saveResult($_SESSION['user_id'], $courseId, $percentage, $total, $answers, $timeTaken);
            
            // Update user progress and XP
            if (isset($_SESSION['user_id'])) {
                $progressService = new ProgressService();
                $xpEarned = $score * 10; // 10 XP per correct answer
                $progressService->recordActivity($_SESSION['user_id'], 'exercise', $xpEarned, $timeTaken);
            }
            
            // Redirect to result view
            view('quiz_result', [
                'score' => $score, 
                'total' => $total, 
                'percentage' => $percentage, 
                'courseId' => $courseId,
                'timeTaken' => $timeTaken
            ]);
        }
    }
}
