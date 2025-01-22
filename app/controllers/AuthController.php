<?php

namespace App\controllers;

use App\models\UserModel;
use App\classes\User;

class LoginController
{
    private UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login(string $email, string $password): void
    {
        $userData = $this->userModel->getUserByEmail($email);

        if ($userData) {
            $user = new User($userData['email'], $userData['password'], $userData['role']);

            if ($user->verifyPassword($password)) {
                session_start();
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['role'] = $user->getRole();
                $_SESSION['is_logged_in'] = true;

                $this->redirectByRole($user->getRole());
            } else {
                $this->renderLoginView('Incorrect password.');
            }
        } else {
            $this->renderLoginView('User not found.');
        }
    }

    private function redirectByRole(string $role): void
    {
        switch ($role) {
            case 'admin':
                header("Location: ../../views/pages/admin/admin.php");
                break;
            case 'teacher':
                header("Location: ../pages/enseignant.php");
                break;
            case 'student':
                header("Location: ../pages/etudiants.php");
                break;
        }
        exit();
    }

    private function renderLoginView(string $error = ''): void
    {
        include __DIR__ . '../../views/login.php';
    }
}
