<?php

namespace App\Controllers;

use App\Classes\User;
use App\Models\UserModel;



class AuthController
{

    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login($user)
    {

        $result = $this->userModel->findUserByEmailAndPassword($user);
        $user = $result['user'];
        if ($user instanceof User) {
            if ($user->getDeletedAt()) {
                $_SESSION['error']['message'] = 'Your account was deleted';
                header("Location: ../auth/login.php");
                exit();
            }

            if ($user->getStatus() === 'suspendu') {
                $_SESSION['error']['message'] = 'Your account is not valid yet!!';
                header("Location: ../auth/login.php");
                exit();
            }

            $this->userModel->connectUser($user);
            $this->createUserSession($result);
            $this->redirectEffect($user);
        } else {
            $_SESSION['error']['message'] = 'Invalid email or password';
            header("Location: ../auth/login.php");
            exit();
        }
    }

    public function signup($user, ...$additionalData)
    {
        try {
            //create user table
            $userNew = $this->userModel->createNewUser($user);
            if ($userNew === 'existe') {
                $_SESSION['error']['message'] = 'Invalid email already exist';
                header("Location: ./register.php");
                exit();
            }
            $result = $this->userModel->insertRole($userNew, ...$additionalData);
            $userInstante = $result['user'];
            if ($userInstante instanceof User) {
                $this->userModel->connectUser($userInstante);
                if ($userInstante->getRole() === 'enseignant') {
                    $this->userModel->removeValidation($userInstante);
                    $_SESSION['success']['message'] = 'Created seccesfuly need admin validat';
                    header("Location: ./login.php");
                    exit;
                }
                $this->createUserSession($result);
                $this->redirectEffect($userInstante);
                return true;
            } else {
                $_SESSION['error']['message'] = 'Invalid email or password';
                header("Location: ./register.php");
                exit();
            }

        } catch (\Exception $e) {
            return 'Registration error: ' . $e->getMessage();
        }
    }

    public function redirectEffect($user)
    {
        switch ($user->getRole()) {
            case 'administrateur':
                header("Location: ../admin/dashboard.php");
                break;
            case 'etudiant':
                header("Location: ../student/home.php");
                break;
            case 'enseignant':

                header("Location: ../teacher/home.php");
                break;

            default:
                echo 'seccess';
                // header("Location: login.php?error=Unknown role");
                break;
        }
        exit;
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            $this->userModel->logout($_SESSION['user']['id']);
            unset($_SESSION['user']);
            session_destroy();
            return true;
        }
        return false;
    }

    private function createUserSession($data)
    {
        $user = $data['user'];
        $id_role = $data['id_role'];
        $_SESSION['user'] = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'id' => $user->getId(),
            'role_id' => $id_role
        ];
    }

}