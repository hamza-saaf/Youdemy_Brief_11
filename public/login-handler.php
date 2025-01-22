<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\controllers\LoginController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $loginController = new LoginController();
    $loginController->login($email, $password);
}
