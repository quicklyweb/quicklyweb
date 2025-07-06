<?php
// © Murat Anur
?><!DOCTYPE html>
<html>
<head>
  <title><?= htmlspecialchars($title) ?> - QuicklyWeb</title>
  <link rel="stylesheet" href="/cms/themes/default/style.css">
</head>
<body>
  <header><h1><?= htmlspecialchars($title) ?></h1></header>
  <main><?= $content ?></main>
  <footer><p>&copy; <?= date('Y') ?> QuicklyWeb</p></footer>
</body>
</html>
