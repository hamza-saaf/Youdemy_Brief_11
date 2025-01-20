<?php

namespace App\models;

use App\config\Database;
use PDO;

class courseModel
{
    private PDO $db;

    public function __construct()
    {
        $conn = Database::connection();
        $this->db = $conn;
    }

    public function getAllCourses(): array
    {
        $query = $this->db->prepare("SELECT * FROM courses");
        $query->execute();
        return $query->fetchAll();
    }
}
