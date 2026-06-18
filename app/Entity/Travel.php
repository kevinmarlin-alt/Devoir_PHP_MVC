<?php
namespace App\Entity;

use DateTime;

/**
 * Représente un trajet.
 */
class Travel {
    
    /**
     * @param int $id
     * @param string $departure_agency
     * @param DateTime $departure_at
     * @param string $arrival_agency
     * @param DateTime $arrival_at
     * @param int $seats_available
     * @param int $seats_total
     * @param int $employee_id
     */
    public function __construct(
        private int $id,
        private string $departure_agency,
        private DateTime $departure_at,
        private string $arrival_agency,
        private DateTime $arrival_at,
        private int $seats_available,
        private int $seats_total,
        private int $employee_id
    ) {

    }

    /**
     * Définit l'identidiant
     * 
     * @param int $id
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * Retourne l'identifiant du trajet
     * 
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * Retourne l'agence de départ du trajet
     * 
     * @return string
     */
    public function getDepartureAgency(): string {
        return $this->departure_agency;
    }

    /**
     * Retourne la date et l'heure de départ du trajet
     * 
     * @return DateTime
     */
    public function getDepartureAt(): DateTime {
        return $this->departure_at;
    }

    /**
     * Retourne l'agence d'arrivé du trajet
     * 
     * @return string
     */
    public function getArrivalAgency(): string {
        return $this->arrival_agency;
    }

    /**
     * Retourne la date et l'heure d'arrivé du trajet
     * 
     * @return DateTime
     */
    public function getArrivalAt(): DateTime {
        return $this->arrival_at;    
    }

    /**
     * Retourne le nombre de places disponible du trajet
     * 
     * @return int
     */
    public function getSeatsAvailable(): int {
        return $this->seats_available;
    }

    /**
     * Retourne le nombre total de places du trajet
     * 
     * @return int
     */
    public function getSeatsTotal(): int {
        return $this->seats_total;
    }

    /**
     * Retourne l'identifiant de l'employé propriétaire du trajet
     * 
     * @return int
     */
    public function getEmployeeId(): int {
        return $this->employee_id;
    }

}