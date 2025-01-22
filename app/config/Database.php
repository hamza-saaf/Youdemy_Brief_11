<?php

namespace App\Config;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private $conn = null;

    public function connect()
    {
        $dotenv = Dotenv::createImmutable(__DIR__. '/../../');
        $dotenv->load();
        // Connect to the database 
        try {
            if ($this->conn !== null) {
                // echo 'seccess2';
                return $this->conn;
            }else{
                $this->conn = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'],$_ENV['DB_USERNAME'],$_ENV['DB_PASSWORD']);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo 'seccess1';
                return $this->conn;
            }
        } catch (PDOException $e) {
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }
}


?>