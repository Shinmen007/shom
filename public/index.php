<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Config\Database;
use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\EditorController;

session_start();

// Basic Router for MVP
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Simple view loader
function view($name, $data = []) {
    extract($data);
    require __DIR__ . "/../src/Views/$name.php";
}

// Route handling
if ($path === '/') {
    view('home');
} elseif ($path === '/login') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new AuthController())->login();
    } else {
        view('login');
    }
} elseif ($path === '/register') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        (new AuthController())->register();
    } else {
        view('register');
    }
} elseif ($path === '/dashboard') {
    (new \App\Controllers\DashboardController())->index();
} elseif ($path === '/logout') {
    (new AuthController())->logout();

// Editor Routes
} elseif ($path === '/editor') {
    (new EditorController())->index();
} elseif ($path === '/tryit') {
    (new EditorController())->tryit();
} elseif ($path === '/api/execute') {
    (new EditorController())->execute();

// Course Routes
} elseif ($path === '/courses') {
    $controller = new CourseController();
    $courses = $controller->index();
    view('courses', ['courses' => $courses]);
} elseif (preg_match('#^/course/(\d+)$#', $path, $matches)) {
    $courseId = $matches[1];
    $controller = new \App\Controllers\LessonController();
    $controller->index($courseId);
} elseif (preg_match('#^/lesson/(\d+)$#', $path, $matches)) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
    $lessonId = $matches[1];
    $controller = new \App\Controllers\LessonController();
    $controller->show($lessonId);
} elseif (preg_match('#^/lesson/(\d+)/complete$#', $path, $matches)) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: /login');
        exit;
    }
    $lessonId = $matches[1];
    (new \App\Controllers\LessonController())->complete($lessonId);
} elseif (preg_match('#^/course/(\d+)/quiz$#', $path, $matches)) {
    if (!isset($_SESSION['user_id'])) { header('Location: /login'); exit; }
    (new \App\Controllers\QuizController())->show($matches[1]);
} elseif (preg_match('#^/course/(\d+)/quiz/submit$#', $path, $matches)) {
    if (!isset($_SESSION['user_id'])) { header('Location: /login'); exit; }
    (new \App\Controllers\QuizController())->submit($matches[1]);
} else {
    http_response_code(404);
    echo "404 Not Found";
}
