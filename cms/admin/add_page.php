<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
    $parent_id = trim($_POST['parent_id']);
    $title = trim($_POST['title']);
    $slug = trim($_POST['slug']);
    $content = trim($_POST['content']);

    if (!$title || !$slug || !$content) {
        $errors[] = "Title, slug and content are required.";
    }

    if ($parent_id === '') {
        $parent_id = null;
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO pages (title, slug, content, parent_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $content, $parent_id]);
        header('Location: pages.php');
        exit;
    }
}

$title = 'Add Page';
$viewPath = '../templates/add_page.php';
include '../templates/admin_base.php';