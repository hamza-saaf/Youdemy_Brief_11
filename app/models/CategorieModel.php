<?php

namespace App\Models;
use App\Config\Database;
use App\Classes\Categorie;

class CategorieModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }


    public function insertCategorie($categorie)
    {
        $isExist = $this->searchCategorieExist($categorie);
        if ($isExist instanceof Categorie) {
            return false;
        } else {
            if ($categorie->getId()) {
                $id = $categorie->getId();
                $categorie_name = $categorie->getCategoryName();
                $query = "UPDATE categories SET title = :title WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':title', $categorie_name);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            }
            $categorie_name = $categorie->getCategoryName();
            $query = "INSERT INTO categories (title) VALUES (:title)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $categorie_name);
            return $stmt->execute();
        }

    }

    public function searchCategorieExist($categorie)
    {
        $categorie_name = $categorie->getCategoryName();
        $query = "SELECT * FROM categories 
        WHERE title = :title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $categorie_name);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return new Categorie($result['id'], $result['title']);
        } else {
            return false;
        }


    }

    public function getAllCategories()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $categories;
    }

    public function getCategoryByIdForUpdate($category_id)
    {
        $query = "SELECT * FROM categories WHERE id = $category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $categories;
    }

    public function dropCayegorie($category_id)
    {
        $query = "DELETE FROM categories WHERE id = $category_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $categories = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $categories;
    }


}
?>