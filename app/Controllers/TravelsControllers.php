<?php
namespace App\Controllers;

use App\Entity\Travel;
use App\Models\TravelsModel;

class TravelsControllers {
    private TravelsModel $travelsModel;

    public function __construct() {
        $this->travelsModel = new TravelsModel();
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