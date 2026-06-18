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
        if($_SESSION['user']['role'] !== 'ADMIN') {
            header('Location: /');
            exit;
        }
    }
}