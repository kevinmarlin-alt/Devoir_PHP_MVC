<?php
namespace App\Models;

use App\Core\Database;
use App\Entity\Travel;
use DateInterval;
use PDO;

class TravelsModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getUsersConnection();
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

            WHERE t.seats_available > 0 AND t.departure_at > NOW()
            ORDER BY t.departure_at ASC"
        );

        $query->execute();

        return $query->fetchAll();
    }
}