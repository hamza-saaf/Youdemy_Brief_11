<?php 

namespace App\Controllers;
use App\Models\AdminModel;


class AdminController implements courseController{

    private AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function createCourse($courseInstent, $selectedTags){
        $this->adminModel->createCourse($courseInstent);
    }

    public function deleteCourse($id){
        $this->adminModel->deleteCourse($id);
    }

    public function getCourseById($id){

    }

    public function getAllCourse(){
        return $this->adminModel->getAllCourse();
    }

    public function countUsers(){
        return $this->adminModel->countUsers();
    }

    public function countUsersActive(){
        return $this->adminModel->countUsersActive();
    }

    public function countEnseignentValid(){
        return $this->adminModel->countEnseignentValid();
    }

    public function getAllEnseignant(){
        return $this->adminModel->getAllEnseignant();
    }

    public function getAllUsers(){
        return $this->adminModel->getAllUsers();
    }

    public function validUser($id){
        return $this->adminModel->validUser($id);
    }

    public function suspendUser($id){
        return $this->adminModel->suspendUser($id);
    }

    public function deleteUser($id){
        return $this->adminModel->deleteUser($id);
    }

    public function getCourseCount(){
        return $this->adminModel->getCourseCount();
    }

    public function mostCoursesInscript(){
        return $this->adminModel->mostCoursesInscript();
    }

    public function mostEnseignantInscriptions(){
        return $this->adminModel->mostEnseignantInscriptions();
    }

    public function getInscriptedOfEachCategory(){
        return $this->adminModel->getInscriptedOfEachCategory();
    }
}





?>