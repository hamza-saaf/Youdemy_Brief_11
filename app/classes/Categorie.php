<?php 

namespace App\Classes;

class Categorie {
    private $id;
    private $category_name;

    public function __construct($id ,$category_name)
    {
        $this->id = $id;
        $this->category_name = $category_name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoryName()
    {
        return $this->category_name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }
    
}





?>
