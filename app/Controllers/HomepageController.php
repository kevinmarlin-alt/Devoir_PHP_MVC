<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\EmployeeModel;

class HomepageController extends Controller {

    public function index() {
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