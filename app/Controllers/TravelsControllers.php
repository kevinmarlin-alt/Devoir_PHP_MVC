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

    public function getTravelById(int $idTravel) {
        return (new TravelsModel)->findTravelById($idTravel);
    }

    public function createIndex() {
        $agencies = (new AgenciesModel)->findAllAgencies();
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $this->render(
            'Créer un trajet', 
            'Travels/create', 
            compact('agencies', 'employee')
        );
    }

    public function updateIndex(int $id) {
        $agencies = (new AgenciesModel)->findAllAgencies();
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $result = $this->getTravelById($id);
        $travel = new Travel(
            id: $result['id'],
            departure_agency: $result['departure_agency'],
            departure_at: $result['departure_at'],
            arrival_agency: $result['arrival_agency'],
            arrival_at: $result['arrival_at'],
            seats_available: $result['seats_available'],
            employee_id: $result['employee_id'],
            seats_total: $result['seats_total']
        );
 
        $this->render(
            'Mettre a jour un trajet',
            'Travels/update',
            compact('employee', 'travel', 'agencies')
        );
    }

    public function updateTravel(int $id, mixed $data) {
        $this->travelsModel->updateTravel($id, $data);
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
                departure_at: $travel['departure_at'],
                arrival_agency: $travel['arrival_agency'],
                arrival_at: $travel['arrival_at'],
                seats_available: $travel['seats_available'],
                seats_total: $travel['seats_total'],
                employee_id: $travel['employee_id']
            ));
            
        };
        return $travels;
    }

    public function deleteTravel(int $id): void {
        $this->travelsModel->deleteOne($id);
    }
}