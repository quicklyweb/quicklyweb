<?php
require_once __DIR__ . '/../core/init.php';
$isLoggedIn = isset($_SESSION['user']);
$isAdmin = $isLoggedIn && $_SESSION['user']['role'] === 'admin';
$username = $isLoggedIn ? htmlspecialchars($_SESSION['user']['username']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Admin Panel' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { font-family: Arial, sans-serif; }
    .sidebar { height: 100vh; padding-top: 1rem; border-right: 1px solid #dee2e6; }
    .sidebar .nav-link.active { font-weight: bold; background-color: #e9ecef; }
    .content { padding: 2rem; }
  </style>
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="position-sticky">
        <h5 class="text-center">Admin</h5>
        <ul class="nav flex-column">
          <li class="nav-item"><a class="nav-link" href="/cms/admin/dashboard.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="/cms/admin/pages.php">Manage Pages</a></li>
          <li class="nav-item"><a class="nav-link" href="/cms/admin/add_page.php">Add Page</a></li>
          <li class="nav-item"><a class="nav-link text-danger" href="/cms/auth/logout.php">Logout</a></li>
        </ul>
      </div>
    </nav>
    <main class="col-md-10 ms-sm-auto content">
      <?php include $viewPath; ?>
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>