<?php
namespace App\Entity;

use DateTime;

class Travel {
    
    public function __construct(
        private int $id,
        private string $departure_agency,
        private string $departure_datetime,
        private string $arrival_agency,
        private string $arrival_datetime,
        private int $seats_available,
        private int $employeeId
    ) {

    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDepartureAgency(): string {
        return $this->departure_agency;
    }

    public function getDepartureDate(): string {
        return new DateTime($this->departure_datetime)->format('d/m/Y');
    }

    public function getDepartureTime(): string {
        return new DateTime($this->departure_datetime)->format('H:i');
    }

    public function getArrivalAgency(): string {
        return $this->arrival_agency;
    }

    public function getArrivalDate(): string {
        return new DateTime($this->arrival_datetime)->format('d/m/Y');    
    }

    public function getArrivalTime(): string {
        return new DateTime($this->arrival_datetime)->format('H:i');
    }

    public function getSeatsAvailable(): int {
        return $this->seats_available;
    }

    public function getEmployeeId(): int {
        return $this->employeeId;
    }

}