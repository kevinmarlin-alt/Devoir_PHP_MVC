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
 * Middleware d'authentification
 */
class AuthMiddleware {

    /**
     * Vérifie qu'un utilisateur est connecté
     * 
     * @return void
     */
    public static function handle(): void {
        if(!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }
}