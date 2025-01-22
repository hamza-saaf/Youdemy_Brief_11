<?php

namespace App\Controllers;
use App\Models\TeacherModel;


class TeacherController implements courseController
{

    private TeacherModel $teacherModel;

    public function __construct()
    {
        $this->teacherModel = new TeacherModel();
    }

    public function createCourse($courseInstent, $selectedTags)
    {
        try {
            $createCourceResult = $this->teacherModel->createNewCourse($courseInstent);
            if ($createCourceResult) {
                $course_id = $createCourceResult->getId();
                $insertTagsResult = $this->teacherModel->insertTagsToOffre($course_id, $selectedTags);
                if ($insertTagsResult) {
                    $_SESSION['success']['message'] = 'Succesecfully created Course';
                    header("Location: ../../Views/teacher/createCourse.php");
                    exit();
                }
            } else {
                $_SESSION['error']['message'] = 'Invalid Cource informations';
                header("Location: ../../Views/teacher/createCourse.php");
                exit();
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteCourse($id)
    {
        $result = $this->teacherModel->deleteCourse($id);
        if($result){
            $_SESSION['success']['message'] = 'Deleted seccesfuly';
            return true;
        }else{
            $_SESSION['error']['message'] = 'Error Deleting';
            return false;
        }
    }

    public function getCourseById($id)
    {
        return $this->teacherModel->getCourseById($id);
    }

    public function getAllCourse()
    {
        return $this->teacherModel->getAllCourse();
    }

    public function updateCourse($courceInstens, $selectedTags)
    {
        $resultCourse = $this->teacherModel->updateCourse($courceInstens);
        if ($resultCourse) {
            $courseID = $courceInstens->getId();
            $resultUpdateTags = $this->teacherModel->updateCourseTags($selectedTags, $courseID);
        }
        if ($resultUpdateTags) {
            $_SESSION['success']['message'] = 'Updated Cours seccesfully';
            header("Location: ../teacher/home.php");
            exit();
        } else {
            $_SESSION['error']['message'] = 'Invalid inputs';
            header("Location: ../teacher/updateCourse.php");
            exit();
        }
    }

    public function getCountCourses()
    {
        return $this->teacherModel->getCountCourses();
    }

    public function getPage($rowsPerPage, $offset ,$studentID)
    {
        $data = $this->teacherModel->getPage($rowsPerPage, $offset,$studentID);
        // header("Location: ../../");
        return $data;
    }

    public function creatInscription($invite , $etudiantId)
    {
        $result = $this->teacherModel->creatInscription($invite , $etudiantId);
        if ($result) {
            $_SESSION['success']['message'] = 'inscription seccesfully';
            header("Location: ../student/home.php");
            exit();
        }else{
            $_SESSION['error']['message'] = 'Already inscripted !';
            header("Location: ../student/home.php");
            exit();
        }
    }

    public function getMyCourses($etudiantId)
    {
        return $this->teacherModel->getMyCourses($etudiantId);
        
    }

    public function removeInsertion($etudiantId,$idCours)
    {
        return $this->teacherModel->removeInsertion($etudiantId,$idCours);
    }

    public function searchFunction($inputData)
    {
        return $this->teacherModel->searchFunction($inputData);
    }

    public function getCourseDemande()
    {
        return $this->teacherModel->getCourseDemande();
    }

}
?>