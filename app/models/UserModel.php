<?php

namespace App\models;

use App\config\Database;
use PDO;

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }

    public function getUserByEmail(string $email): ?array
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute([':email' => $email]);
        $user = $query->fetch();

        return $user ?: null;
    }
    public function createUser(): bool {
        // Example: Save user to the database
        echo "User '{$this->name}' created successfully!";
        return true;
    }

    public function approveTeacher(): bool {
        if ($this->role === 'teacher' && $this->status === 'pending') {
            $this->status = 'approved';
            echo "Teacher '{$this->name}' approved successfully!";
            return true;
        }
        echo "Unable to approve user '{$this->name}'.";
        return false;
    }
}
