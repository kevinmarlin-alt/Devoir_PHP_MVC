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
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $this->render(
            'Tableau de bord', 
            'dashboard', 
            compact('employees', 'agencies', 'travels', 'employee')
        );
    }

    /**
     * Affiche la page de modification d'une agence
     * 
     * @param int $id
     * @return void
     */
    public function updateAgencyIndex(int $id): void {
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $agency = $this->agenciesController->getAgencyById($id);
 
        $this->render(
            'Mettre a jour un trajet',
            'Agencies/update',
            compact('employee', 'agency')
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