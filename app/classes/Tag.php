<?php 


namespace App\Classes;

class Tag {
    private $id;
    private $tag_name;

    public function __construct($id ,$tag_name)
    {
        $this->id = $id;
        $this->tag_name = $tag_name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTagName()
    {
        return $this->tag_name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTagName($tag_name)
    {
        $this->tag_name = $tag_name;
    }
    
}