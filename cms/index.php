<?php
require_once __DIR__ . '/core/init.php';
require_once __DIR__ . '/core/Database.php';

use Core\Database;

$config = require __DIR__ . '/config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

$page_slug = $_GET['page'] ?? 'home';

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

include __DIR__ . '/templates/base.php';