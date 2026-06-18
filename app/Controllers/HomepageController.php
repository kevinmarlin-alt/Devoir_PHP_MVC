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
 * Contrôleur de la page d'accueil
 */
class HomepageController extends Controller {

    /**
     * Affiche la page d'accueil
     * 
     * @return void
     */
    public function index(): void {
        $travels = (new TravelsControllers)->getAvailableTravels();
        $employee = null;
        if(isset($_SESSION['user'])) {
            $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        }
        $this->render(
            title:'Accueil',
            view: 'homepage',
            vars: compact('travels', 'employee')
        );
    }

}