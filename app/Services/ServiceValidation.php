<?php 

namespace App\Services;

class ServiceValidation{

    public static function loginValidation($user){
            $email = $user->getEmail();
            $password = $user->getPassword();
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/";
            $passwordPattern = "/^[A-Za-z0-9]{4,}$/";

            if (!preg_match($emailPattern, $email)) {
                $_SESSION['error']['message'] = 'Invalid email format.';
                return false;
            }
            
            // Validate password
            if (!preg_match($passwordPattern, $password)) {
                $_SESSION['error']['message'] = 'Invalid Password.';
                return false;
            }
            return true;

    }

    public static function registerValidation($user, ...$data){
        $name = $user->getName();
        $email = $user->getEmail();
        $password = $user->getPassword();
        if ($user->getRole() === 'etudiant') {
            $niveau = $data[0];
            if(empty($niveau)){
                return false;
            }
        }else{
            $spesialite = $data[0];
            $status = $data[1];
            if(empty($spesialite) || preg_match('/\d/', $spesialite)){
                $_SESSION['error']['message'] = 'Invalid spesialite value.';
                return false;
            }
            if(empty($status) || preg_match('/\d/', $status)){
                return false;
            }
        }
        if(empty($name) || preg_match('/\d/', $name)){
            $_SESSION['error']['message'] = 'Invalid name value.';
            return false;
        }
        $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/";
        $passwordPattern = "/^.{6,}$/";

        if (!preg_match($emailPattern, $email)) {
            $_SESSION['error']['message'] = 'Invalid email format.';
            return false;
        }
            
        // Validate password
        if (!preg_match($passwordPattern, $password)) {
            $_SESSION['error']['message'] = 'Invalid Password.';
            return false;
        }
        return true ;

    }

    public static function categorieValidation($categorie){

        if(empty($categorie) || preg_match('/\d/', $categorie)){
            $_SESSION['error']['message'] = 'Invalid categorie value.';
            return false;
        }
        return true;
    }

    public static function courseValidation($contenu) {
        $title = $contenu->getTitle();
        $description = $contenu->getDescription();
        $contenu_type = $contenu->getContenuType();
        $contenu_url = $contenu->getContenuUrl();
        $enseignant_id = $contenu->getEnseignantId();
        $categorie_id = $contenu->getCategorieId();
    
        // Validate Title
        if (empty($title) || preg_match('/[^a-zA-Z0-9\s]/', $title)) {
            $_SESSION['error']['message'] = 'Invalid title. It must not be empty.';
            return false;
        }
    
        // Validate Description
        if (empty($description)) {
            $_SESSION['error']['message'] = 'Invalid description. It must not be empty or contain numbers.';
            return false;
        }
    
        // Validate Contenu Type
        if (empty($contenu_type) || preg_match('/\d/', $contenu_type)) {
            $_SESSION['error']['message'] = 'Invalid contenu type. It must not be empty or contain numbers.';
            return false;
        }
    
        // Validate Contenu URL
        if (empty($contenu_url) || !filter_var($contenu_url, FILTER_VALIDATE_URL)) {
            $_SESSION['error']['message'] = 'Invalid URL. Please provide a valid URL.';
            return false;
        }
    
        // Validate Enseignant ID
        if (empty($enseignant_id) ) {
            $_SESSION['error']['message'] = 'Invalid enseignant ID. It must be a number.';
            return false;
        }
    
        // Validate Categorie ID
        if (empty($categorie_id) ) {
            $_SESSION['error']['message'] = 'Invalid categorie ID. It must be a number.';
            return false;
        }
    
        return true;
    }
    


}









?>