<?php
namespace App\Models;

use App\Core\Database;
use App\Entity\Employee;
use PDO;

class EmployeeModel {
    private PDO $pdo;

    public function __construct(
    ) {
        $this->pdo = Database::getAdminConnection();
    }

    public function findEmployeeByEmail(string $email) {
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

    public function findEmployeeById(int $id) {
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

    public function addPassword() {
        $password = password_hash("Test", PASSWORD_BCRYPT);
        var_dump($password);
        
        $query = $this->pdo->prepare(
            "UPDATE employees SET passeword = :passeword  WHERE email = 'arthur.henry@email.fr'"
        );

        $query->execute([
            ':passeword' => $password
        ]);
    }

}