<?php

namespace App\Controllers;

use App\Models\Course;
use App\Config\DatabaseSeeder;

class CourseController {
    
    public function index() {
        $courseModel = new Course();
        $courses = $courseModel->getAll();
        
        // If no courses exist, seed them for the MVP demo
        if (empty($courses)) {
            (new DatabaseSeeder())->seed();
            $courses = $courseModel->getAll();
        }

        return $courses;
    }
}
