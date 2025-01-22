<?php

namespace App\Classes;

class Course
{
    private $id;
    private $title;
    private $description;
    private $contenu_type;
    private $contenu_url;
    private $enseignant_id;
    private $categorie_id;
    private $date_creation;

    // Constructor
    public function __construct($id ,$title, $description, $contenu_type, $contenu_url, $enseignant_id, $categorie_id ,$date_creation = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->contenu_type = $contenu_type;
        $this->contenu_url = $contenu_url;
        $this->enseignant_id = $enseignant_id;
        $this->categorie_id = $categorie_id;
        $this->date_creation = $date_creation;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getContenuType()
    {
        return $this->contenu_type;
    }

    public function getContenuUrl()
    {
        return $this->contenu_url;
    }

    public function getEnseignantId()
    {
        return $this->enseignant_id;
    }

    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    public function getDateCreation()
    {
        return $this->date_creation;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setContenuType($contenu_type)
    {
        $this->contenu_type = $contenu_type;
    }

    public function setContenuUrl($contenu_url)
    {
        $this->contenu_url = $contenu_url;
    }

    public function setEnseignantId($enseignant_id)
    {
        $this->enseignant_id = $enseignant_id;
    }

    public function setCategorieId($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }
}

?>
