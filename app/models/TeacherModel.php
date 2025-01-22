<?php

namespace App\Models;
use App\Config\Database;
use App\Classes\Course;

class TeacherModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function createNewCourse($courseInstent)
    {
        try {
            $title = $courseInstent->getTitle();
            $description = $courseInstent->getDescription();
            $contenu_type = $courseInstent->getContenuType();
            $contenu_url = $courseInstent->getContenuUrl();
            $enseignant_id = $courseInstent->getEnseignantId();
            $categorie_id = $courseInstent->getCategorieId();
            $query = "INSERT INTO cours (title , description , contenu_type , contenu_url, enseignant_id, categorie_id)
                VALUES (:title, :description, :contenu_type, :contenu_url, :enseignant_id, :categorie_id)";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':contenu_type', $contenu_type);
            $stmt->bindParam(':contenu_url', $contenu_url);
            $stmt->bindParam(':enseignant_id', $enseignant_id);
            $stmt->bindParam(':categorie_id', $categorie_id);
            $stmt->execute();
            $couseID = $this->conn->lastInsertId();
            if ($couseID) {
                $query = "SELECT * FROM cours
                where id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $couseID);
                $stmt->execute();
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);
                return new Course($row['id'], $row['title'], $row['description'], $row['contenu_type'], contenu_url: $row['contenu_url'], enseignant_id: $row['enseignant_id'], categorie_id: $row['categorie_id'], date_creation: $row['date_creation']);
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function insertTagsToOffre($course_id, $selectedTags)
    {
        try {
            foreach ($selectedTags as $tag) {
                $query = "INSERT INTO cours_tags (cours_id, tag_id)
                VALUES (:cours_id, :tag_id)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':tag_id', $tag);
                $stmt->bindParam(':cours_id', $course_id);
                $stmt->execute();
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAllCourse()
    {
        $query = "SELECT
    cours.id,
    cours.title as coursTitle,
    description,
    contenu_type,
    categories.title as categorieTitel,
    contenu_url,
    enseignant_id,
    enseignants.status as ensStatus,
    users.name as userName,
    tags.id as tagId,
    categories.id as categorieId,
    GROUP_CONCAT(tags.title) as tags,
    GROUP_CONCAT(tags.id) as tagID,
    COUNT(DISTINCT inscriptions.id) as CounterInsert
FROM
    cours
    INNER JOIN inscriptions ON inscriptions.cours_id = cours.id
    INNER JOIN categories ON categories.id = cours.categorie_id
    INNER JOIN cours_tags ON cours.id = cours_tags.cours_id
    INNER JOIN tags ON cours_tags.tag_id = tags.id
    INNER JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    INNER JOIN users ON users.id = enseignants.user_id
GROUP BY
    cours.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function getCourseById($id)
    {
        $query = "SELECT
    cours.id,
    cours.title as coursTitle,
    description,
    contenu_type,
    categories.title as categorieTitel,
    contenu_url,
    enseignant_id,
    enseignants.status as ensStatus,
    users.name as userName,
    tags.id as tagId,
    categories.id as categorieId,
    GROUP_CONCAT(tags.title) as tags,
    GROUP_CONCAT(tags.id) as tagID
FROM
    cours
    INNER JOIN categories ON categories.id = cours.categorie_id
    INNER JOIN cours_tags ON cours.id = cours_tags.cours_id
    INNER JOIN tags ON cours_tags.tag_id = tags.id
    INNER JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    INNER JOIN users ON users.id = enseignants.user_id
    WHERE cours.id = :id
    GROUP BY
    cours.id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteCourse($id)
    {
        $query = "DELETE FROM cours WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateCourse($courceInstens)
    {
        $id = $courceInstens->getId();
        $title = $courceInstens->getTitle();
        $description = $courceInstens->getDescription();
        $contenu_type = $courceInstens->getContenuType();
        $contenu_url = $courceInstens->getContenuUrl();
        $enseignant_id = $courceInstens->getEnseignantId();
        $categorie_id = $courceInstens->getCategorieId();

        $query = "UPDATE cours SET title = :title, description = :description, contenu_type = :contenu_type, contenu_url = :contenu_url, enseignant_id = :enseignant_id, categorie_id = :categorie_id
        WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':contenu_type', $contenu_type);
        $stmt->bindParam(':contenu_url', $contenu_url);
        $stmt->bindParam(':enseignant_id', $enseignant_id);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute() ? true : false;
    }

    public function updateCourseTags($selectedTags, $coursID)
    {

        try {
            $query = "DELETE FROM cours_tags 
            WHERE cours_id = :coursID";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':coursID', $coursID);
            if ($stmt->execute()) {
                foreach ($selectedTags as $tag_id) {
                    $query = "INSERT INTO cours_tags (cours_id , tag_id)
                    VALUES (:cours_id, :tag_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':cours_id', $coursID);
                    $stmt->bindParam(':tag_id', $tag_id);
                    $stmt->execute();
                }
            }
            return true;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            return false;
        }
    }
    public function getCountCourses()
    {
        $query = "SELECT COUNT(*) FROM cours";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }

    public function getCourseDemande()
    {
        $query = "SELECT title FROM cours_demonder";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPage($rowsPerPage, $offset, $studentID)
    {
        $query = "SELECT
        cours.id,
        cours.title as coursTitle,
        description,
        contenu_type,
        categories.title as categorieTitel,
        contenu_url,
        enseignant_id,
        enseignants.status as ensStatus,
        users.name as userName,
        tags.id as tagId,
        categories.id as categorieId,
        GROUP_CONCAT(tags.title) as tags,
        GROUP_CONCAT(tags.id) as tagID,
        COUNT(DISTINCT inscriptions.id) as CounterInsert ";
        if($studentID){
            $query .= ",
                (etudiants.id IS NOT NULL) AS isIncripted 
                ";
        }

        $query .= " FROM
        cours ";

    $query .= " LEFT JOIN inscriptions ON inscriptions.cours_id = cours.id ";
    if($studentID){
        $query .= " LEFT JOIN etudiants ON {$studentID} = inscriptions.etudiant_id ";
        }
    $query .= " INNER JOIN categories ON categories.id = cours.categorie_id
    INNER JOIN cours_tags ON cours.id = cours_tags.cours_id
    INNER JOIN tags ON cours_tags.tag_id = tags.id
    INNER JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    INNER JOIN users ON users.id = enseignants.user_id
GROUP BY cours.id
    LIMIT :offset OFFSET :rowsPerPage";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue('offset', (int) $rowsPerPage, \PDO::PARAM_INT);
        $stmt->bindValue('rowsPerPage', (int) $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function creatInscription($coursID, $etudiantId)
    {
        $isInscripted = $this->ifAlreadyInscript($coursID, $etudiantId);
        if ($isInscripted) {
            $query = "INSERT INTO inscriptions (etudiant_id, cours_id) VALUE (:etudiant_id, :cours_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam('etudiant_id', $etudiantId);
            $stmt->bindParam('cours_id', $coursID);
            return $stmt->execute();
        } else {
            return false;
        }
    }
    public function ifAlreadyInscript($coursID, $etudiantId)
    {
        $query = "SELECT COUNT(*) FROM inscriptions WHERE etudiant_id = :etudiant_id AND cours_id = :cours_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':etudiant_id', $etudiantId);
        $stmt->bindParam(':cours_id', $coursID);
        $stmt->execute();

        $count = $stmt->fetchColumn();
        return $count < 1;
    }

    public function removeInsertion($etudiantId, $idCours)
    {
        $query = "DELETE FROM inscriptions WHERE etudiant_id = :etudiant_id AND cours_id = :cours_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam('etudiant_id', $etudiantId);
        $stmt->bindParam('cours_id', $idCours);
        return $stmt->execute();
    }

    public function getMyCourses($etudiantId)
    {
        $query = "SELECT 
    cours.id,
    cours.title as coursTitle,
    description,
    contenu_type,
    categories.title as categorieTitel,
    contenu_url,
    enseignant_id,
    enseignants.status as ensStatus,
    users.name as userName,
    cours.contenu_type,
    tags.id as tagId,
    categories.id as categorieId,
    GROUP_CONCAT(tags.title) as tags,
    GROUP_CONCAT(tags.id) as tagID
FROM
    cours
    INNER JOIN categories ON categories.id = cours.categorie_id
    INNER JOIN cours_tags ON cours.id = cours_tags.cours_id
    INNER JOIN tags ON cours_tags.tag_id = tags.id
    INNER JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    INNER JOIN users ON users.id = enseignants.user_id
    INNER JOIN inscriptions ON inscriptions.cours_id = cours.id
WHERE inscriptions.etudiant_id = :id
GROUP BY
    cours.id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue('id', (int) $etudiantId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function searchFunction($inputData)
    {
        $query = "SELECT DISTINCT
            cours.id,
            cours.title as coursTitle,
            description,
            contenu_type,
            categories.title as categorieTitel,
            contenu_url,
            enseignant_id,
            enseignants.status as ensStatus,
            users.name as userName,
            tags.id as tagId,
            categories.id as categorieId,
            GROUP_CONCAT(tags.title) as tags,
            GROUP_CONCAT(tags.id) as tagID    
            FROM
            cours
            INNER JOIN categories ON categories.id = cours.categorie_id
            INNER JOIN cours_tags ON cours.id = cours_tags.cours_id
            INNER JOIN tags ON cours_tags.tag_id = tags.id
            INNER JOIN enseignants ON enseignants.user_id = cours.enseignant_id
            INNER JOIN users ON users.id = enseignants.user_id
        WHERE
            cours.title LIKE :searchPattern
            OR categories.title LIKE :searchPattern
            OR tags.title LIKE :searchPattern
        GROUP BY
            cours.id, 
            cours.title, 
            cours.description, 
            cours.contenu_type, 
            categories.title, 
            cours.contenu_url, 
            cours.enseignant_id, 
            enseignants.status, 
            users.name, 
            categories.id";

        $stmt = $this->conn->prepare($query);

        $searchPattern = '%' . $inputData . '%';

        // Bind the parameter
        $stmt->bindParam(':searchPattern', $searchPattern, \PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}