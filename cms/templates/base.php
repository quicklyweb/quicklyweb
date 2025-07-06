<?php
// © Murat Anur
?><!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>
    <div><?= $content ?? '' ?></div>
</body>
</html>
