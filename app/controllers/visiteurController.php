<?php

namespace App\controllers;

use App\models\visiteurModel;

class visiteurController
{
    private visiteurModel $visiteurModel;

    public function __construct()
    {
        $this->visiteurModel = new visiteurModel();
    }

    public function display(): void
    {
        $disp = $this->visiteurModel->getAllvisiteur();


        include __DIR__ . '../../views/pages/courses/course.php'; // Pass data to the view
    }
   
}
