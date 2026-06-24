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
use PDOStatement;

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
    public function __construct(?PDO $pdo = null)
    {
        $this->pdo =  $pdo ?? Database::getConnection();
    }

    /**
     * Recherche toutes les agences
     * 
     * @return Agency[]|array
     */
    public function findAllAgencies(): array {
        /**
         * @var PDOStatement|false $query
         */
        $query = $this->pdo->prepare(
            "SELECT * FROM agencies ORDER BY city ASC"
        );

        if ($query === false) {
            return [];
        }
        $query->execute();

        /**
         * @var array<int,array<string,mixed>> $result
         */
        $result = $query->fetchAll();

        if(!$result) {
            return [];
        }


        $agencies = [];

        /** @var array{
         *      id:int,
         *      city:string
         * } $agency
         */
        foreach($result as $agency){
            array_push($agencies, new Agency(
                id: $agency['id'],
                city: $agency['city']
            ));
        };
        return $agencies;
    }

    /**
     * Recherche une agences
     * 
     * @param int $id
     * @return Agency|null
     */
    public function findOne(int $id): Agency|null {
        $query = $this->pdo->prepare(
            "SELECT * FROM agencies WHERE id = :id"
        );
        $query->execute([
            'id' => $id
        ]);

        /**
         * @var array{
         *      id:int,
         *      city:string
         * }|null $result
         */
        $result = $query->fetch();
 
        if(!$result) {
            return null;
        }

        return new Agency(
                id: $result['id'],
                city: $result['city']
            );
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
     * Met à jour le nom d'une agence
     * 
     * @param array{
     *      city:string
     * } $data
     * @return bool
     */
    public function updateAgency(int $id, mixed $data): bool {
        $query = $this->pdo->prepare(
            "UPDATE 
                agencies 
            SET 
                city = :city
            WHERE 
                id = :id"
        );

        return $query->execute([
            'id' => $id,
            'city' => $data['city']
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