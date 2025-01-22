<?php
session_start();
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\config\Database;
use PDO;

class authModel{
    private PDO $db;
    public function __construct()
    {
        $conn = Database::connection();
        $this->db = $conn;
    }
    public function x(){
        if (isset($_POST['connecter'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
          
            } else {
                 echo 'Email et Mot de passe sont Obligatoires';
            
          
            }
      
    }
}