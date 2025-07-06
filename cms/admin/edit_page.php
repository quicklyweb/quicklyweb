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

// Get ID
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: pages.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$id]);
$page = $stmt->fetch();

if (!$page) {
    header('Location: pages.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = trim($_POST['content']);

    if (!$title || !$slug || !$content) {
        $errors[] = "All fields are required.";
    }

    if (empty($errors)) {
        $update = $pdo->prepare("UPDATE pages SET title = ?, slug = ?, content = ? WHERE id = ?");
        $update->execute([$title, $slug, $content, $id]);
        header('Location: pages.php');
        exit;
    }
}

$title = 'Edit Page';
$viewPath = '../templates/edit_page.php';
include '../templates/admin_base.php';
?>
