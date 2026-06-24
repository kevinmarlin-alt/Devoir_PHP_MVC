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

        /** @var array<string,mixed> $user */
        $user = $_SESSION['user'];
        if(!isset($user['id'])) {
            exit;
        }
        /** @var int $id */
        $id = $user['id'];
        $employee = (new EmployeeController)->getEmployeeById($id);
        $this->render(
            'Tableau de bord', 
            'dashboard', 
            compact('employees', 'agencies', 'travels', 'employee')
        );
    }

    /**
     * Affiche la page de modification d'une agence
     * 
     * @param int $idAgency
     * @return void
     */
    public function updateAgencyIndex(int $idAgency): void {

        /** @var array<string,mixed> $user */
        $user = $_SESSION['user'];

        /** @var int $id */
        $id = $user['id'];

        $employee = (new EmployeeController)->getEmployeeById($id);
        $agency = $this->agenciesController->getAgencyById($idAgency);
 
        $this->render(
            'Mettre a jour une agence',
            'Agencies/update',
            compact('employee', 'agency')
        );
    }
}