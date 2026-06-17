<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Entity\Travel;
use App\Models\EmployeeModel;
use App\Models\TravelsModel;
use App\Models\AgenciesModel;
use DateTime;

class TravelsControllers extends Controller {
    private TravelsModel $travelsModel;

    public function __construct() {
        $this->travelsModel = new TravelsModel();
    }

    public function createIndex() {
        $agencies = (new AgenciesModel)->findAllAgencies();
        $employee = (new EmployeeModel)->findEmployeeById($_SESSION['user']['id']);
        $this->render(
            'Créer un trajet', 
            'travels/create', 
            compact('agencies', 'employee')
        );
    }

    public function createNewTravel(): void {
        $departure_at = $_POST['departure_date'] . " " . $_POST['departure_time'] . ":00";
        $arrival_at = $_POST['arrival_date'] . " " . $_POST['arrival_time'] . ":00";
        var_dump($_POST);
        (new TravelsModel)->addTravel($departure_at, $arrival_at);
        header('Location: /');
  
    }

    public function getAvailableTravels(): array {
    
        $result = $this->travelsModel->findAllTravelsAvailable();

        if(!$result) {
            return [];          
        }

        $travels = [];
        foreach($result as $travel) {
            array_push($travels, new Travel(
                id: $travel['id'],
                departure_agency: $travel['departure_agency'],
                departure_datetime: $travel['departure_at'],
                arrival_agency: $travel['arrival_agency'],
                arrival_datetime: $travel['arrival_at'],
                seats_available: $travel['seats_available'],
                employeeId: $travel['employee_id']
            ));
            
        };
        return $travels;
    }
}