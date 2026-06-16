<?php
namespace App\Entity;

class Employee {

    public function __construct(
        private int $id,
        private string $lastname,
        private string $firstname,
        private string $phone,
        private string $email,
        private string $password,
        private string $role,
    ){}

    public function getId(): int {
        return $this->id;
    }

    public function getPassword(): string {
        return $this->password;
    }
}