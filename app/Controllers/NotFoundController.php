<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;

/**
 * Contrôleur des pages non trouvées
 */
class NotFoundController extends Controller {
    
    /**
     * Affiche la page 404
     * 
     * @return void
     */
    public function index(): void {
        $employee = null;
        if(isset($_SESSION['user'])) {
            $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        }
        $this->render(
            'erreur 404',
            '404',
            compact('employee')
        );
    }
}