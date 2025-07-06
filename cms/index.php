<?php
// © Murat Anur
// Load core and database
require_once __DIR__ . '/core/init.php';
require_once __DIR__ . '/core/Database.php';

use Core\Database;

// Load config and connect to DB
$config = require __DIR__ . '/config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

// Get page slug from URL or default to 'home'
$page_slug = $_GET['page'] ?? 'home';

// Fetch the page from DB
$stmt = $pdo->prepare("SELECT * FROM pages WHERE slug = ?");
$stmt->execute([$page_slug]);
$page = $stmt->fetch();

if ($page) {
    $title = $page['title'];
    $content = $page['content'];
    $viewPath = __DIR__ . '/templates/page.php';
} else {
    $title = 'Page Not Found';
    $viewPath = __DIR__ . '/templates/404.php';
}

// Determine theme to use (default for now)
$theme = 'default';
$themePath = __DIR__ . "/themes/$theme/index.php";

// If the theme layout exists, use it, else fallback to templates/base.php
if (file_exists($themePath)) {
    include $themePath;
} else {
    include __DIR__ . '/templates/base.php';
}