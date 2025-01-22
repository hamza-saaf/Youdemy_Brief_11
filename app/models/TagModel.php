<?php

namespace App\Models;
use App\Classes\Tag;
use App\Config\Database;



class TagModel
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function insertTag($tags)
    {
        if ($tags->getId() === null) {
            $tagsNames = $tags->getTagName();
            foreach ($tagsNames as $tag) {
                $isExist = $this->searchTagExist($tag);
                if(!($isExist instanceof Tag)){
                    $query = "INSERT INTO tags (title) VALUES (:title)";
                    $stmt = $this->conn->prepare($query);
                    $stmt->bindParam(':title', $tag);
                    $stmt->execute();
                }else{
                    return false;
                }
            }
            return true;
        }else{
            $tagName = $tags->getTagName();
            $tag = $tags->getTagName();
            $isExist = $this->searchTagExist($tagName);
            if ($isExist instanceof Tag) {
                return false;
            } else {
                $id = $tags->getId();
                // $tag_name = $tag[0];
                $query = "UPDATE tags SET title = :title WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':title', $tagName);
                $stmt->bindParam(':id', $id);
                return $stmt->execute();
            }
            
        }

    }

    public function searchTagExist($tag)
    {
        $query = "SELECT * FROM tags 
        WHERE title = :title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $tag);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($result) {
            return new Tag($result['id'], $result['title']);
        } else {
            return false;
        }
    }

    public function getAllTags()
    {
        $query = "SELECT * FROM tags";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function dropTag($tag_id)
    {
        $query = "DELETE FROM tags WHERE id = :title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $tag_id);
        return $stmt->execute();
    }

}
?>