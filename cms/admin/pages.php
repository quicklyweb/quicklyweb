<?php
require_once '../core/init.php';
require_once '../core/Auth.php';
require_once '../core/Database.php';

use Core\Auth;
use Core\Database;

if (!Auth::isAdmin()) {
    header('Location: ../auth/login.php');
    exit;
}

$config = require '../config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

$stmt = $pdo->query("SELECT * FROM pages ORDER BY created_at DESC");
$pages = $stmt->fetchAll();

$title = 'Manage Pages';
$viewPath = '../templates/admin_pages.php';
include '../templates/admin_base.php';