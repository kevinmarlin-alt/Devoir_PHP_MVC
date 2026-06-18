<?php
namespace App\Models;

use App\Core\Database;
use App\Entity\Agency;
use PDO;

class AgenciesModel {
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getAdminConnection();
    }

    public function findAllAgencies(): array|null {
        $query = $this->pdo->prepare(
            "SELECT * FROM agencies ORDER BY city ASC"
        );
        $query->execute();

        $result = $query->fetchAll();

        if(!$result) {
            return null;
        }

        $employees = [];
        foreach($result as $employee){
            array_push($employees, new Agency(
                id: $employee['id'],
                city: $employee['city']
            ));
        };
        return $employees;
    }

    public function createAgency(array $data): void {
        $query = $this->pdo->prepare(
            "INSERT INTO agencies (
                city
            ) VALUES (
                :city
            )"
        );

        $query->execute([
            'city' => $data['city']
        ]);
    }
}