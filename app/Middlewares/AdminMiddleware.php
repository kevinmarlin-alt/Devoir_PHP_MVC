<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Middlewares;

/**
 * Middleware de contrôle administrateur
 */
class AdminMiddleware {

    /**
     * Vérifie que l'utilisateur possède le rôle ADMIN.
     *
     * @return void
     */
    public static function handle(): void {
        /** @var array<string,string> $user */
        $user = $_SESSION['user'];
        
        if($user['role'] !== 'ADMIN') {
            header('Location: /');
            exit;
        }
    }
}