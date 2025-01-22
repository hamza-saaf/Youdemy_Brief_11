<?php

namespace App\Controllers;

interface courseController {


    public function createCourse($courseInstent, $selectedTags);

    public function deleteCourse($id);

    public function getCourseById($id);

    public function getAllCourse();

    
}







?>