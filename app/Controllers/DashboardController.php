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
use App\Controllers\EmployeeController;
use App\Controllers\AgenciesController;
use Exception;
use Throwable;

use function PHPUnit\Framework\throwException;

/**
 * Contrôleur du tableau de bord
 */
class DashboardController extends Controller {
    private AgenciesController $agenciesController;

    public function __construct()
    {
        $this->agenciesController = new AgenciesController();
    }

    /**
     * Affiche le tableau de bord administrateur
     * 
     * @return void
     */
    public function index(): void {
        $employees = (new EmployeeController)->getAllEmployees();
        $agencies = (new AgenciesController)->getAllAgencies();
        $travels = (new TravelsControllers)->getAllTravels();
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $this->render(
            'Tableau de bord', 
            'dashboard', 
            compact('employees', 'agencies', 'travels', 'employee')
        );
    }

    /**
     * Supprime une agence et affiche un message
     * 
     * @param int $id
     * @return void
     */
    public function deleteAgency(int $id): void {
        $isDelete = $this->agenciesController->deleteAgency($id);
        if(!$isDelete) {
            // message d'erreur 
            exit;
        }

        // message de confirmation

        
    }
}