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
use App\Entity\Agency;
use PDO;

/**
 * Modèle de gestion des agences
 */
class AgenciesModel {

    /**
     * Connexion PDO
     * 
     * @var PDO $pdo
     */
    private PDO $pdo;

    /**
     * Initialise le modèle
     */
    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    /**
     * Recherche toutes les agences
     * 
     * @return Agency[]|null
     */
    public function findAllAgencies(): array|null {
        $query = $this->pdo->prepare(
            "SELECT * FROM agencies ORDER BY city ASC"
        );
        $query->execute();

        $result = $query->fetchAll();

        if(!$result) {
            return null;
        }

        $agencies = [];
        foreach($result as $agency){
            array_push($agencies, new Agency(
                id: $agency['id'],
                city: $agency['city']
            ));
        };
        return $agencies;
    }

    /**
     * Crée une agence
     * 
     * @param string $city
     * @return bool
     */
    public function createAgency(string $city): bool {
        $query = $this->pdo->prepare(
            "INSERT INTO agencies (
                city
            ) VALUES (
                :city
            )"
        );

        return $query->execute([
            'city' => $city
        ]);
    }

    /**
     * Supprime une agence
     * 
     * @param int $id
     * @return bool
     */
    public function deleteOne(int $id): bool {
        $query = $this->pdo->prepare(
            "DELETE FROM agencies WHERE id = :id"
        );

        return $query->execute([
            'id' => $id
        ]);
    }
}