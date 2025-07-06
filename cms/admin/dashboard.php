<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../core/init.php';
require_once '../core/Auth.php';

use Core\Auth;

if (!Auth::isAdmin()) {
    header('Location: ../auth/login.php');
    exit;
}

$title = 'Admin Dashboard';
$viewPath = '../templates/admin_dashboard.php';
include '../templates/admin_base.php';