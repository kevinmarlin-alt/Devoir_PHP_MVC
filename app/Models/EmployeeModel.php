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
use App\Entity\Employee;
use PDO;

/**
 * Modèle de gestion des employés
 */
class EmployeeModel {

    /**
     * Connexion PDO
     * 
     * @var PDO
     */
    private PDO $pdo;

    /**
     * Initialise le modèle
     */
    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    /**
     * Recherche un employé a partir de son email
     * 
     * @param string $email
     * @return Employee|null
     */
    public function findEmployeeByEmail(string $email): Employee|null {
        $query = $this->pdo->prepare(
            "SELECT * FROM employees 
            WHERE email = :email
            "
        );

        $query->execute([
            ":email" => $email
        ]);

        $result = $query->fetch();

        if(!$result) {
            return null;
        }

        return new Employee(
            id: $result['id'],
            lastname: $result['lastname'],
            firstname: $result['firstname'],
            phone: $result['phone'],
            email: $result['email'],
            password: $result['passeword'],
            role: $result['role']
        );
    }

    /**
     * Recherche un employé a partir de son identifiant
     * 
     * @param int $id
     * @return Employee|null
     */
    public function findEmployeeById(int $id): Employee|null {
        $query = $this->pdo->prepare(
            "SELECT * FROM employees 
            WHERE id = :id
            "
        );

        $query->execute([
            ":id" => $id
        ]);

        $result = $query->fetch();

        if(!$result) {
            return null;
        }

        return new Employee(
            id: $result['id'],
            lastname: $result['lastname'],
            firstname: $result['firstname'],
            phone: $result['phone'],
            email: $result['email'],
            password: $result['passeword'],
            role: $result['role']
        );

    }

    /**
     * Recherche la liste de tous les employés
     * 
     * @return Employee[]|null
     */
    public function findAllEmployees(): array|null {
        $query = $this->pdo->prepare(
            "SELECT * FROM employees"
        );

        $query->execute();

        $result = $query->fetchAll();

        if(!$result) {
            return null;
        }

        $employees = [];
        foreach($result as $employee) {
            array_push($employees, new Employee(
                id: $employee['id'],
                lastname: $employee['lastname'],
                firstname: $employee['firstname'],
                phone: $employee['phone'],
                email: $employee['email'],
                password: $employee['passeword'] ?? "",
                role: $employee['role']
            ));
        }

        return $employees;
    }

    /**
     * Met à jour le mot de passe d'un employé
     * 
     * @param int $id
     * @param string $password
     * @return bool
     */
    public function addPassword(int $id, string $password): bool {
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);
        var_dump($passwordHashed);
        
        $query = $this->pdo->prepare(
            "UPDATE 
                employees 
            SET 
                passeword = :passwordHashed  
            WHERE 
                id = :id"
        );

        return $query->execute([
            ':passwordHashed' => $passwordHashed,
            'id' => $id
        ]);
    }

}