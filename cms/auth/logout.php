<?php
require_once '../core/init.php';
require_once '../core/Auth.php';

use Core\Auth;

Auth::logout();
header('Location: login.php');
exit;