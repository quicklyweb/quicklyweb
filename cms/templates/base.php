<?php
require_once __DIR__ . '/../core/init.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'My CMS' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-white text-black">
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom mb-4">
  <div class="container">
    <a class="navbar-brand" href="/cms/">My CMS</a>
  </div>
</nav>
<main class="container py-4">
  <?php include $viewPath; ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>