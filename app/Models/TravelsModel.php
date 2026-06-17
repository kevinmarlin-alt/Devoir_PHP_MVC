<?php
namespace App\Models;

use App\Core\Database;
use App\Entity\Travel;
use DateInterval;
use DateTime;
use PDO;

class TravelsModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getUsersConnection();
    }

    public function findTravelById(int $id) {
        $query = $this->pdo->prepare(
            "SELECT 
                t.id,
                dep.city AS departure_agency,
                t.departure_at,
                arr.city AS arrival_agency,
                t.arrival_at,
                t.seats_available,
                t.seats_total,
                t.employee_id
            FROM travels t

            INNER JOIN agencies dep
                ON dep.id = t.departure_agency_id

            INNER JOIN agencies arr
                ON arr.id = t.arrival_agency_id 
            
            WHERE t.id = :id"
        );

        $query->execute(['id' => $id]);

        return $query->fetch();
    }

    public function findAllTravelsAvailable() {
        
        $query = $this->pdo->prepare(
            "SELECT 
                t.id,
                dep.city AS departure_agency,
                t.departure_at,
                arr.city AS arrival_agency,
                t.arrival_at,
                t.seats_available,
                t.seats_total,
                t.employee_id
            FROM travels t

            INNER JOIN agencies dep
                ON dep.id = t.departure_agency_id

            INNER JOIN agencies arr
                ON arr.id = t.arrival_agency_id

            WHERE 
                t.seats_available > 0 
                AND 
                t.departure_at > NOW()

            ORDER BY 
                t.departure_at 
                ASC"
        );

        $query->execute();

        return $query->fetchAll();
    }

    public function addTravel(string $departure_at, string $arrival_at) {
        $query = $this->pdo->prepare(
            "INSERT INTO travels (
                departure_agency_id,
                arrival_agency_id,
                departure_at,
                arrival_at,
                seats_total,
                seats_available,
                employee_id
            ) VALUES (
                :departure_agency_id,
                :arrival_agency_id,
                :departure_at,
                :arrival_at,
                :seats_total,
                :seats_total,
                :employee_id
            )"
        );

        $query->execute([
            'departure_agency_id' => $_POST['departure_agency_id'],
            'arrival_agency_id' => $_POST['arrival_agency_id'],
            'departure_at' => $departure_at,
            'arrival_at' => $arrival_at,
            'seats_total' => $_POST['seats_total'],
            'seats_available' => $_POST['seats_total'],
            'employee_id' => $_POST['employee_id'],
        ]);
    }

    public function updateTravel(int $id, mixed $data) {
        $query = $this->pdo->prepare(
            "UPDATE 
                travels 
            SET 
                departure_agency_id = :departure_agency_id,
                departure_at = :departure_at,
                arrival_agency_id = :arrival_agency_id,
                arrival_at = :arrival_at,
                seats_available = :seats_available,
                seats_total = :seats_total
            WHERE 
                id = :id"
        );

        $query->execute([
            'id' => $id,
            'departure_agency_id' => $data['departure_agency_id'],
            'departure_at' => $data['departure_date'] . " " . $data['departure_time'] . ":00",
            'arrival_agency_id' => $data['arrival_agency_id'],
            'arrival_at' => $data['arrival_date'] . " " . $data['arrival_time']. ":00",
            'seats_available' => $data['seats_available'],
            'seats_total' => $data['seats_total']
        ]); 
    }
}