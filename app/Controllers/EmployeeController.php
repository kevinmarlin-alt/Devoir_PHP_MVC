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
        $employee = $this->employeeModel->findEmployeeById($id);
        return new Employee(
            id: $employee['id'],
            lastname: $employee['lastname'],
            firstname: $employee['firstname'],
            phone: $employee['phone'],
            email: $employee['email'],
            password: $employee['passeword'],
            role: $employee['role']
        );
    }
}