<?php
namespace App\Core;

/**
 * Classe abstraite de base pour tous les contrôleurs.
 *
 * Fournit les fonctionnalités communes de rendu des vues.
 */
abstract class Controller {

    /**
     * Affiche une vue dans le layout principal.
     *
     * @param string $title Titre de la page.
     * @param string $view Nom de la vue à charger.
     * @param array<string,mixed> $vars Variables transmises à la vue.
     *
     * @return void
     */
    protected function render(string $title, string $view, array $vars = []) {
        extract($vars);
        require_once __DIR__ . "/../Views/Layouts/index.php";
    }
}