<?php 

namespace App\Controllers;
use App\Classes\Categorie;
use App\Models\CategorieModel;

class CategorieController{
    
    private CategorieModel $categorieModel;

    public function __construct()   {
       $this->categorieModel = new CategorieModel();
    }

    public function createCategorie($category_name, $category_id){
        if($category_id){
            $categorie = new Categorie($category_id ,$category_name);
        }else{
            $categorie = new Categorie(null ,$category_name);
        }

        $resultInsert = $this->categorieModel->insertCategorie($categorie);
        if($resultInsert){
            $_SESSION['success']['message'] = $category_name .' Successfully';
        }else{
            $_SESSION['error']['message'] = $category_name .' Category already exist';
            header("Location: ../../Views/admin/category.php");
            exit();
        }
    }

    public function getCatigories(){
        return $this->categorieModel->getAllCategories();
    }

   
    public function deleteCategoryById($category_id){
        $this->categorieModel->dropCayegorie($category_id);
        $_SESSION['success']['message'] = 'Deleted Successfully';
    }
}

?>