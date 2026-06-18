<?php

namespace App\Core;

use PDO;

/**
 * Gestionnaire de connexion à la base de données.
 */
class Database {
    /**
     * Instance PDO partagée.
     *
     * @var PDO
     */
    private static PDO $pdo;

    /**
     * Retourne une connexion adaptée au rôle connecté.
     * 
     * @return PDO
     */
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
}
