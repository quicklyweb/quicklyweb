<?php
require_once '../core/init.php';
require_once '../core/Auth.php';

use Core\Auth;

if (!Auth::isAdmin()) {
    header('Location: ../auth/login.php');
    exit;
}

echo "<h1>Admin Dashboard</h1>";
echo "<p>Welcome, " . htmlspecialchars($_SESSION['user']['username']) . "!</p>";
echo '<p><a href="../auth/logout.php">Logout</a></p>';