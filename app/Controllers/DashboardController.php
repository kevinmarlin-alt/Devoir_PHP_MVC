<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Controllers\EmployeeController;
use App\Controllers\AgenciesController;

class DashboardController extends Controller {

    public function index() {
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
}