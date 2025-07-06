<?php
require_once '../core/init.php';
require_once '../core/Auth.php';
require_once '../core/Database.php';

use Core\Auth;
use Core\Database;

// Admin only
if (!Auth::isAdmin()) {
    header('Location: ../auth/login.php');
    exit;
}

$config = require '../config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = trim($_POST['content']);

    if (!$title || !$slug || !$content) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO pages (title, slug, content) VALUES (?, ?, ?)");
        $stmt->execute([$title, $slug, $content]);
        header('Location: pages.php');
        exit;
    }
}

$title = 'Add Page';
$viewPath = '../templates/add_page.php';
include '../templates/admin_base.php';
?>
