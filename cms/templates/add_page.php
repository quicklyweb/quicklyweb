<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
// © Murat Anur
require_once '../core/init.php';
require_once '../core/Database.php';
require_once '../templates/admin_base.php';

use Core\Database;

$config = require '../config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

// Handle form submission
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $parent_id = $_POST['parent_id'] ?: null;

    // Slug duplication check
    $check = $pdo->prepare("SELECT COUNT(*) FROM pages WHERE slug = ?");
    $check->execute([$slug]);
    if ($check->fetchColumn() > 0) {
        $error = "Slug already exists. Please choose a unique slug.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO pages (title, slug, content, parent_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$title, $slug, $content, $parent_id]);
        header('Location: pages.php');
        exit;
    }
}

// Fetch top-level pages for parent dropdown
$stmt = $pdo->query("SELECT id, title FROM pages WHERE parent_id IS NULL ORDER BY title");
$parentPages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
  <h2>Add Page</h2>

  <?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input type="text" name="slug" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Content</label>
      <textarea name="content" class="form-control" rows="8"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Parent Page</label>
      <select name="parent_id" class="form-control">
        <option value="">No Parent</option>
        <?php foreach ($parentPages as $p): ?>
          <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Save Page</button>
  </form>
</div>
