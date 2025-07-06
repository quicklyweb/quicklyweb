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

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: pages.php');
    exit;
}

$config = require '../config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

$stmt = $pdo->prepare("DELETE FROM pages WHERE id = ?");
$stmt->execute([$id]);

header('Location: pages.php');
exit;