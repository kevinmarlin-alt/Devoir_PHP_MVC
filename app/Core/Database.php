<?php

namespace App\Core;

use PDO;


class Database {
    private static PDO $pdo;

    public static function getAdminConnection(): PDO {
        $usersDB = require __DIR__ . "/../env.php";
        $admin = $usersDB['admin'];
        self::$pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $admin['host'],
                $admin['dbname']
            ),
                $admin['user'],
                $admin['password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
        );
        return self::$pdo;
    }

    public static function getUsersConnection(): PDO {
        $usersDB = require __DIR__ . "/../env.php";
        $users = $usersDB['users'];
        self::$pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $users['host'],
                $users['dbname']
            ),
                $users['user'],
                $users['password'],
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
        );
        return self::$pdo;
    }
}
