<?php 


namespace App\Controllers;
use App\Classes\Tag;
use App\Models\TagModel;

class TagController{
    
    private TagModel $tagModel;

    public function __construct()   {
       $this->tagModel = new TagModel();
    }

    public function createTag($tag_name, $tag_id){
        if($tag_id){
            $tag = new Tag($tag_id ,$tag_name);
        }else{
            $tag = new Tag(null ,$tag_name);
        }

        $resultInsert = $this->tagModel->insertTag($tag);
        if($resultInsert){
            $_SESSION['success']['message'] = 'Successfully';
        }else{
            $_SESSION['error']['message'] = 'Tag already exist';
            header("Location: ../../Views/admin/tag.php");
            exit();
        }
    }

    public function getTags(){
        return $this->tagModel->getAllTags();
    }
   
    public function deleteTagById($tag_id){
        $result = $this->tagModel->dropTag($tag_id);
        if($result){
            $_SESSION['success']['message'] = 'Successfully';
        }else{
            $_SESSION['error']['message'] = 'Tag already exist';
            header("Location: ../../Views/admin/tag.php");
            exit();
        }
    }

}



?>