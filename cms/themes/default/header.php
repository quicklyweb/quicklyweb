<?php
// © Murat Anur

// Fetch all pages
$stmt = $pdo->query("SELECT id, title, slug, parent_id FROM pages ORDER BY parent_id, title");
$allPages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organize pages into parent-child structure
$menu = [];
foreach ($allPages as $page) {
    if (!$page['parent_id']) {
        $menu[$page['id']] = $page;
        $menu[$page['id']]['children'] = [];
    }
}
foreach ($allPages as $page) {
    if ($page['parent_id'] && isset($menu[$page['parent_id']])) {
        $menu[$page['parent_id']]['children'][] = $page;
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/cms">QuicklyWeb</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php foreach ($menu as $item): ?>
          <?php if (!empty($item['children'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="/cms/<?= $item['slug'] ?>" role="button" data-bs-toggle="dropdown">
                <?= htmlspecialchars($item['title']) ?>
              </a>
              <ul class="dropdown-menu">
                <?php foreach ($item['children'] as $child): ?>
                  <li><a class="dropdown-item" href="/cms/<?= $child['slug'] ?>"><?= htmlspecialchars($child['title']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="/cms/<?= $item['slug'] ?>"><?= htmlspecialchars($item['title']) ?></a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</nav>
