<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\controllers\courseController;

// Route to show courses
$controller = new courseController();
$controller->showCourses();
?>