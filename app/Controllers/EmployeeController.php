<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Controllers;

use App\Entity\Employee;
use App\Models\EmployeeModel;

/**
 * Contrôleur des employés
 */
class EmployeeController {

    /**
     * @var EmployeeModel $employeeModel
     */
    private EmployeeModel $employeeModel;

    /**
     * Initialise le contrôleur
     */
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    /**
     * Retourne un employé en fonction de son identifiant
     * 
     * @param int $id
     * @return Employee|null
     */
    public function getEmployeeById(int $id): Employee|null {
        return $this->employeeModel->findEmployeeById($id);

    }

    /**
     * Retourne tous les employés
     * 
     * @return Employee[]|null
     */
    public function getAllEmployees(): array|null {
        return $this->employeeModel->findAllEmployees();
    }

    /**
     * Met à jour le mot de passe d'un employé
     * 
     * @param int $id
     * @param array<string,string> $data
     */
    public function updatePassword(int $id, array $data): bool {
        $passwordHashed = password_hash($data['pwd'], PASSWORD_BCRYPT);
        return $this->employeeModel->addPassword($id, $passwordHashed);
    }
}