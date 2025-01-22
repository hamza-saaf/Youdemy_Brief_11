<?php

namespace App\controllers;

use App\models\courseModel;

class courseController
{
    private courseModel $courseModel;

    public function __construct()
    {
        $this->courseModel = new courseModel();
    }

    public function showCourses(): void
    {
        $courses = $this->courseModel->getAllCourses();
        

        include __DIR__ . '../../views/pages/course.php'; // Pass data to the view
    }
}