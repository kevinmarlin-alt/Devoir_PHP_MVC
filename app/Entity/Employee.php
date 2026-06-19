<?php
namespace App\Entity;

/**
 * Représente un employé.
 */
class Employee {

    /**
     * @param int $id
     * @param string $lastname
     * @param string $firstname
     * @param string $phone
     * @param string $email
     * @param string $password
     * @param string $role
     */
    public function __construct(
        private int $id,
        private string $lastname,
        private string $firstname,
        private string $phone,
        private string $email,
        private string $password,
        private string $role,
    ){}

    /**
     * Retourne l'identifiant de l'enployé
     * 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Retourne le mot de passe hashé
     * 
     * @return string
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Retourne le prénom de l'employé
     * 
     * @return string
     */
    public function getFirstname(): string {
        return $this->firstname;
    }

    /**
     * Retourne le nom de l'employé
     * 
     * @return string
     */
    public function getLastname(): string {
        return $this->lastname;
    }

    /**
     * Retourne l'email de l'employé
     * 
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Retourne le numéro de téléphone de l'employé
     * 
     * @return string
     */
    public function getPhone(): string {
        return $this->phone;
    }

    /**
     * Retourne le nom complet de l'employé
     * 
     * @return string
     */
    public function getFullname(): string {
        return $this->firstname . " " . $this->lastname;
    }

    /**
     * Retourne le rôle de l'employé
     * 
     * @return string
     */
    public function getRole(): string {
        return $this->role;
    }

    /**
     * Retourne un tableau des propriétées
     * 
     * @return array
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'role' => $this->role
        ];
    }
}