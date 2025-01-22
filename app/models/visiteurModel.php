<?php

namespace App\models;

use App\config\Database;
use PDO;

class visiteurModel
{
    private PDO $db;
   
    public function __construct()
    {
        $conn = Database::connection();
        $this->db = $conn;
    }


}


