<?php 
session_start();

require '../../vendor/autoload.php';
use App\Controllers\AuthController;

$auth = new AuthController();
$res = $auth->logout();
if ($res) {
    header('Location: .\auth\login.php');
}




?>