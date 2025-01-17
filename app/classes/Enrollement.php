<?php
namespace App\classes;

class Enrollement
{
    private int $id;
    private string $cours;
    private $enrolled_at;
    //construct
    public function __construct($id, $cours, $enrolled_at)
    {
        $this->id = $id;
        $this->cours = $cours;
        $this->enrolled_at = $enrolled_at;
    }
    //getters
    public function getId(){
        return $this->id;
    }
    public function getCours(){
        return $this->cours;
    }
    public function getEnrolled_at(){
        return $this->enrolled_at;
    }
    //setters
    public function setId($id){
        $this->id=$id;
    }
    public function setCours($cours){
        $this->cours=$cours;
    }
    public function setEnrolled_at($setEnrolled_at){
        $this->enrolled_at=$setEnrolled_at;
    }
}
