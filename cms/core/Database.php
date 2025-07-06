<?php
namespace Core;

use PDO;
use PDOException;

class Database {
    public static $pdo;

    public static function connect($config) {
        try {
            self::$pdo = new PDO(
                "mysql:host={$config['host']};dbname={$config['name']};charset=utf8mb4",
                $config['user'],
                $config['pass']
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}