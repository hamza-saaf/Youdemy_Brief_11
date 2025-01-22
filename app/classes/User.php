<?php 

namespace App\Classes;

class User{

    protected $id;
    protected $name;
    protected $email;
    protected $password;
    protected $role;
    protected $isActive;
    protected $statut;
    protected $date_creation;
    protected $deletedAt;

    public function __construct($id, $name, $email, $password, $role = null, $isActive = null, $statut = null, $date_creation = null, $deletedAt = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->isActive = $isActive;
        $this->statut = $statut;
        $this->date_creation = $date_creation;
        $this->deletedAt = $deletedAt;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getIsActive() {
        return $this->isActive;
    }
    
    public function getStatus() {
        return $this->statut;
    }

    public function getDateCreation() {
        return $this->date_creation;
    }
    public function getDeletedAt() {
        return $this->deletedAt;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }
    
    public function setStatus($statut) {
        $this->statut = $statut;
    }

    public function setDateCreation($date_creation) {
        $this->date_creation = $date_creation;
    }
    public function setDeletedAt($deletedAt) {
        $this->deletedAt = $deletedAt;
    }


}



?>