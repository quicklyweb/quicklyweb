<?php
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
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$email || !$password) {
        $errors[] = 'All fields are required.';
    }

    if (empty($errors)) {
        try {
            Auth::register($username, $email, $password);
            header('Location: login.php');
            exit;
        } catch (Exception $e) {
            $errors[] = 'Registration failed: ' . $e->getMessage();
        }
    }
}

$title = 'Register';
$viewPath = '../templates/register.php';
include '../templates/base.php';