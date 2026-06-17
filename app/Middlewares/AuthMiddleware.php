<?php
namespace App\Middlewares;

class AuthMiddleware {

    public static function handle(): void {
        if(!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }
}