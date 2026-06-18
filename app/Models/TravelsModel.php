<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Models;

use App\Core\Database;
use App\Entity\Travel;
use DateTime;
use PDO;

/**
 * Modèle de gestion des trajets
 */
class TravelsModel {

    /**
     * Connexion PDO
     * 
     * @var PDO $pdo
     */
    private PDO $pdo;

    /**
     * Initialise le modèle
     */
    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Recherche un trajet à partir de son identifiant
     * 
     * @param int $id
     * @return Travel|null
     */
    public function findTravelById(int $id): Travel|null {
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

        $result = $query->fetch();

        if(!$result) {
            return null;
        }

        return new Travel(
            id: $result['id'],
            departure_agency: $result['departure_agency'],
            departure_at: new DateTime($result['departure_at']),
            arrival_agency: $result['arrival_agency'],
            arrival_at: new DateTime($result['arrival_at']),
            seats_available: $result['seats_available'],
            employee_id: $result['employee_id'],
            seats_total: $result['seats_total']
        );
    }

    /**
     * Recherche tous les trajets disponible en fonction du nombre de places et de la date
     * 
     * Retourne tous les trajets qui sont encore disponible à la date et heure actuelle et uniquement les trajets qui disposent encore de places disponible.
     * 
     * @return Travel[]|null
     */
    public function findAllTravelsAvailable(): array|null {
        
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

        $result = $query->fetchAll();

        if(!$result) {
            return null;
        }

        $travels = [];
        foreach($result as $travel) {
            array_push($travels, new Travel(
                id: $travel['id'],
                departure_agency: $travel['departure_agency'],
                departure_at: new DateTime($travel['departure_at']),
                arrival_agency: $travel['arrival_agency'],
                arrival_at: new DateTime($travel['arrival_at']),
                seats_available: $travel['seats_available'],
                employee_id: $travel['employee_id'],
                seats_total: $travel['seats_total']
            ));
        }

        return $travels;
    }

    /**
     * Crée un trajet 
     * 
     * @param mixed $data
     * @return bool
     */
    public function addTravel(mixed $data): bool {
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

        return $query->execute([
            'departure_agency_id' => $data['departure_agency_id'],
            'departure_at' => $data['departure_date'] . " " . $data['departure_time'] . ":00",
            'arrival_agency_id' => $data['arrival_agency_id'],
            'arrival_at' => $data['arrival_date'] . " " . $data['arrival_time']. ":00",
            'seats_total' => $data['seats_total'],
            'seats_available' => $data['seats_total'],
            'employee_id' => $data['employee_id'],
        ]);
    }

    /**
     * Met à jour un trajet
     * 
     * @param int $id
     * @param mixed $data
     * @return bool
     */
    public function updateTravel(int $id, mixed $data): bool {
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

        return $query->execute([
            'id' => $id,
            'departure_agency_id' => $data['departure_agency_id'],
            'departure_at' => $data['departure_date'] . " " . $data['departure_time'] . ":00",
            'arrival_agency_id' => $data['arrival_agency_id'],
            'arrival_at' => $data['arrival_date'] . " " . $data['arrival_time']. ":00",
            'seats_available' => $data['seats_available'],
            'seats_total' => $data['seats_total']
        ]); 
    }

    /**
     * Supprime un trajet
     * 
     * @param int $id
     * @return bool
     */
    public function deleteOne(int $id): bool {
        $query = $this->pdo->prepare(
            "DELETE FROM travels WHERE id = :id"
        );

        return $query->execute(['id' => $id]);
    }

    /**
     * Recherche tous les trajets
     * 
     * @return Travel[]|null
     */
    public function findAllTravels(): array|null {
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

            ORDER BY 
                t.departure_at 
                ASC"
        );

        $query->execute();

        $result = $query->fetchAll();

        if(!$result) {
            return null;
        }

        $travels = [];
        foreach($result as $travel) {
            array_push($travels, new Travel(
                id: $travel['id'],
                departure_agency: $travel['departure_agency'],
                departure_at: new DateTime($travel['departure_at']),
                arrival_agency: $travel['arrival_agency'],
                arrival_at: new DateTime($travel['arrival_at']),
                seats_available: $travel['seats_available'],
                employee_id: $travel['employee_id'],
                seats_total: $travel['seats_total']
            ));
        }

        return $travels;
    }
}