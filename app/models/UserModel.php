<?php

namespace App\Models;
use App\Config\Database;
use App\Classes\User;
use \PDO;

class UserModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function findUserByEmailAndPassword($user)
    {
        $email = $user->getEmail();
        $passwprd = $user->getPassword();

        $query = "SELECT * FROM users
            where email = :email AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $passwprd);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            if($row['role'] !== 'administrateur'){
                $id_role = $this->getUserRoleId($row["id"], $row['role']);
            }else{
                $id_role = $row['id'];

            }
            return [
                'user' => new User($row['id'], $row['name'], $row['email'], $row['password'], $row['role'], $row['isActive'], statut: $row['statut'], date_creation: $row['date_creation'], deletedAt: $row['deletedAt']),
                'id_role' => $id_role
            ];
        } else {
            return false;
        }
    }

    public function createNewUser($user)
    {
        try {
            $name = $user->getName();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $role = $user->getRole();
            $ifExist = $this->ifEmailExist($user);
            if ($ifExist) {
                return 'existe';
            } else {
                $query = "INSERT INTO users (name , email , password , role)
                          VALUES (:name, :email, :password, :role)";

                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':role', $role);
                $stmt->execute();
                $userID = $this->conn->lastInsertId();

                $query = "SELECT * FROM users where id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $userID);
                $stmt->execute();
                $row = $stmt->fetch();
                return new User($row['id'], $row['name'], $row['email'], $row['password'], $row['role'], $row['isActive'], $row['statut'], $row['date_creation'], $row['deletedAt']);
            }
        } catch (\Throwable $e) {
            return 'Registration error: ' . $e->getMessage();
        }

    }

    public function insertRole($user, ...$additionalData)
    {
        try {
            $id = $user->getId();
            switch ($user->getRole()) {
                case 'etudiant':
                    $niveau = $additionalData[0];
                    $query = "INSERT INTO etudiants ( niveau, user_id)
                              VALUES ( :niveau, :user_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':niveau', $niveau);
                    $stmt->bindParam(':user_id', $id);
                    break;

                case 'enseignant':
                    $spesialite = $additionalData[0];
                    $status = $additionalData[1];
                    $query = "INSERT INTO enseignants (spesialite, status, user_id)
                              VALUES (:spesialite, :status, :user_id)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':spesialite', $spesialite);
                    $stmt->bindParam(':status', $status);
                    $stmt->bindParam(':user_id', $id);
                    break;

                default:
                    echo 'Role is not exist';
                    break;
            }
            //i have to hundel the return of $user
            if ($stmt->execute()) {
                $lastInsertId = $this->conn->lastInsertId();
                return [
                    'user' => $user,
                    'id_role' => $lastInsertId,
                ];
            } else {
                return false;
            }
        } catch (\Throwable $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function getUserRoleId($idUser, $role)
    {
        $query = "SELECT id FROM {$role}s
            where user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function logout($idUser)
    {
        $query = "UPDATE users SET isActive = 0 where id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $idUser, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function ifEmailExist($user)
    {
        $email = $user->getEmail();

        $query = "SELECT 1 FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch() ? true : false;
    }

    public function deleteUser($user)
    {
        $id = $user->getId();

        $query = "UPDATE users
                  SET deletedAt = CURRENT_DATE
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function removeValidation($user)
    {
        $id = $user->getId();
        $query = "UPDATE users
                  SET statut = 'suspendu'
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function checkValidation($user)
    {
        $id = $user->getId();

        $query = "SELECT statut FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        if ($result === 'valide') {
            return true;
        }else{
            return false;
        }
    }

    public function connectUser($user)
    {
        $id = $user->getId();
        $query = "UPDATE users
                  SET isActive = true
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function deconnectUser($user)
    {
        $id = $user->getId();
        $query = "UPDATE users
                  SET isActive = false
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }


}
?>