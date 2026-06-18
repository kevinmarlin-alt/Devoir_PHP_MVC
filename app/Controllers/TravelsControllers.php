<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\TravelsModel;
use App\Models\AgenciesModel;

class TravelsControllers extends Controller {
    private TravelsModel $travelsModel;

    public function __construct() {
        $this->travelsModel = new TravelsModel();
    }

    public function getTravelById(int $idTravel) {
        return $this->travelsModel->findTravelById($idTravel);
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
        $travel = $this->getTravelById($id);
 
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

    public function getAllTravels(): array|null {
        return $this->travelsModel->findAllTravels();

    }

    public function getAvailableTravels(): array|null {
        return $this->travelsModel->findAllTravelsAvailable();
    }

    public function deleteTravel(int $id): void {
        $this->travelsModel->deleteOne($id);
    }
}