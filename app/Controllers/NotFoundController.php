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

        /** @var array<string,mixed> $user */
        $user = $_SESSION['user'];

        if(isset($user['id'])) {
            /** @var int $id */
            $id = $user['id'];
            
            $employee = (new EmployeeController)->getEmployeeById($id);
        }
        $this->render(
            'erreur 404',
            '404',
            compact('employee')
        );
    }
}