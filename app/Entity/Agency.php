<?php
namespace App\Entity;

/**
 * Représente une agence.
 */
class Agency {

    /**
     * @param int $id Identifiant de l'agence.
     * @param string $city Nom de la ville de l'agence.
     */
    public function __construct(
        private int $id,
        private string $city
    ){}

    /**
     * Retourne l'identifiant.
     * 
     * @return int
     */
    public function getId(): int{
        return $this->id;
    }

    /**
     * Retourne le nom de la ville
     * 
     * @return string
     */
    public function getCity(): string{
        return $this->city;
    }

    /**
     * Retourne un tableau des propriétées
     * 
     * @return array<string,mixed>
     */
    public function toArray(): mixed
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
        ];
    }
}