<?php

namespace App\Core;

use PDO;


class Database {
    private static PDO $pdo;

    public static function getConnection(): PDO {
        $usersDB = require __DIR__ . "/../env.php";

        $profil = $usersDB['USERS'];
        
        if(isset($_SESSION['user'])){
            if($_SESSION['user']['role'] === 'ADMIN') {
                $profil = $usersDB['ADMIN'];
            }
        }

        self::$pdo = new PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;charset=utf8mb4',
                $profil['host'],
                $profil['dbname']
            ),
                $profil['user'],
                $profil['password'],
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
