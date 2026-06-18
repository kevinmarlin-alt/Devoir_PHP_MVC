<?php
namespace App\Middlewares;

class AdminMiddleware {

    public static function handle(): void {
        if($_SESSION['user']['role'] !== 'ADMIN') {
            header('Location: /');
            exit;
        }
    }
}