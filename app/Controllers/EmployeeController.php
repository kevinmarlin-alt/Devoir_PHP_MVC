<?php
namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Entity\Employee;

class EmployeeController {
    private EmployeeModel $employeeModel;
    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function getEmployeeById(int $id) {
        return $this->employeeModel->findEmployeeById($id);

    }

    public function getAllEmployees(): array {
        return $this->employeeModel->findAllEmployees();
    }
}