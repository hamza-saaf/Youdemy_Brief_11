<?php

namespace App\Models;
use App\Config\Database;
use \PDO;

class AdminModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function countUsers() {
        $query = "SELECT COUNT(*) FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countUsersActive() {
        $query = "SELECT COUNT(*) FROM users
        WHERE isActive = true";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countEnseignentValid() {
        $query = "SELECT COUNT(*) FROM users
        WHERE statut = 'valide' AND role = 'enseignant'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAllEnseignant() {
        $query = "SELECT * FROM users
        INNER JOIN enseignants ON users.id = enseignants.user_id
        WHERE  role = 'enseignant'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function validUser($id) {
        $query = "UPDATE users SET statut = 'valide'
        WHERE id = {$id}";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
    
    public function suspendUser($id) {
        $query = "UPDATE users SET statut = 'suspendu'
        WHERE id = {$id}";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
    
    public function deleteUser($id) {
        $query = "UPDATE users SET `deletedAt` = CURRENT_TIMESTAMP
        WHERE id = {$id}";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }

    public function deleteCourse($id) {
        $query = "DELETE FROM cours WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function createCourse($courseInstent) {
        $query = "INSERT INTO cours_demonder (title) value (:title)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $courseInstent);
        return $stmt->execute();
    }

    public function getCourseCount() {
        $query = "SELECT COUNT(*) FROM cours";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function mostCoursesInscript() {
        $query = "SELECT
        cours.title AS coursTitle
    FROM
        cours
    LEFT JOIN inscriptions ON inscriptions.cours_id = cours.id
    GROUP BY
        cours.id, cours.title
    ORDER BY
        COUNT(inscriptions.etudiant_id) DESC
    LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function mostEnseignantInscriptions() {
        $query = "SELECT
    users.name AS enseignantName
FROM
    cours
    LEFT JOIN inscriptions ON inscriptions.cours_id = cours.id
    LEFT JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    LEFT JOIN users ON users.id = enseignants.user_id
GROUP BY
    users.id, users.name
ORDER BY
    COUNT(inscriptions.etudiant_id) DESC
LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAllCourse() {
        $query = "SELECT
    cours.id,
    cours.title AS coursTitle,
    cours.contenu_type,
    categories.title AS categorieTitle,
    cours.enseignant_id,
    enseignants.status AS ensStatus,
    users.name AS userName,
    COUNT(inscriptions.etudiant_id) AS totalEtudiants
FROM
    cours
    LEFT JOIN inscriptions ON inscriptions.cours_id = cours.id
    LEFT JOIN categories ON categories.id = cours.categorie_id
    LEFT JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    LEFT JOIN users ON users.id = enseignants.user_id
GROUP BY
    cours.id,
    cours.title,
    cours.contenu_type,
    categories.title,
    cours.enseignant_id,
    enseignants.status,
    users.name
ORDER BY
    totalEtudiants DESC;
";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getInscriptedOfEachCategory() {
        $query = "SELECT
        cours.id,
        cours.title as coursTitle,
        categories.title as categorieTitel,
        categories.id as categorieId,
        COUNT(DISTINCT inscriptions.id) as counter
    FROM
        cours
    INNER JOIN inscriptions ON inscriptions.cours_id = cours.id
    INNER JOIN categories ON categories.id = cours.categorie_id
    INNER JOIN cours_tags ON cours.id = cours_tags.cours_id
    INNER JOIN enseignants ON enseignants.user_id = cours.enseignant_id
    INNER JOIN users ON users.id = enseignants.user_id
GROUP BY categories.id
ORDER BY counter DESC limit 3;
";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}