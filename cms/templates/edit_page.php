<?php
// © Murat Anur
require_once '../core/init.php';
require_once '../core/Database.php';
require_once '../templates/admin_base.php';

use Core\Database;

$config = require '../config/config.php';
Database::connect($config['db']);
$pdo = Database::$pdo;

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "Page ID is required.";
    exit;
}

// Fetch current page data
$stmt = $pdo->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->execute([$id]);
$page = $stmt->fetch();

if (!$page) {
    echo "Page not found.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $parent_id = $_POST['parent_id'] ?: null;

    // Prevent setting the page as its own parent
    if ($parent_id == $id) {
        echo "<div class='alert alert-danger'>A page cannot be its own parent.</div>";
    } else {
        $stmt = $pdo->prepare("UPDATE pages SET title = ?, slug = ?, content = ?, parent_id = ? WHERE id = ?");
        $stmt->execute([$title, $slug, $content, $parent_id, $id]);

        header('Location: pages.php');
        exit;
    }
}

// Fetch other top-level pages for parent selection
$stmt = $pdo->prepare("SELECT id, title FROM pages WHERE parent_id IS NULL AND id != ?");
$stmt->execute([$id]);
$parentPages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-4">
  <h2>Edit Page</h2>
  <form method="post">
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" value="<?= htmlspecialchars($page['title']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input type="text" name="slug" value="<?= htmlspecialchars($page['slug']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Content</label>
      <textarea name="content" class="form-control" rows="8"><?= htmlspecialchars($page['content']) ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Parent Page</label>
      <select name="parent_id" class="form-control">
        <option value="">No Parent</option>
        <?php foreach ($parentPages as $p): ?>
          <option value="<?= $p['id'] ?>" <?= ($page['parent_id'] == $p['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['title']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Page</button>
  </form>
</div>
