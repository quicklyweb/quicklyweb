<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../core/init.php';
require_once '../core/Database.php';
require_once '../core/Auth.php';

use Core\Database;
use Core\Auth;

$config = require '../config/config.php';
Database::connect($config['db']);
Auth::setDB(Core\Database::$pdo);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (Auth::login($email, $password)) {
    $redirect = Auth::isAdmin() ? '../admin/dashboard.php' : '../client/index.php';
    header('Location: ' . $redirect);
    exit;
    } else {
        $errors[] = 'Invalid login credentials.';
    }
}

$title = 'Login';
$viewPath = '../templates/login.php';
include '../templates/base.php';