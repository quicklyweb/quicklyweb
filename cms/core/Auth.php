<?php
namespace Core;

use PDO;

class Auth {
    protected static $db;

    public static function setDB(PDO $pdo) {
        self::$db = $pdo;
    }

    public static function register($username, $email, $password) {
        $stmt = self::$db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public static function login($email, $password) {
        $stmt = self::$db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            return true;
        }
        return false;
    }

    public static function logout() {
        $_SESSION = [];
        session_destroy();
    }

    public static function check() {
        return isset($_SESSION['user']);
    }

    public static function isAdmin() {
        return self::check() && $_SESSION['user']['role'] === 'admin';
    }
}