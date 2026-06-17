<?php
namespace App\Entity;

use DateTime;

class Travel {
    
    public function __construct(
        private int $id,
        private string $departure_agency,
        private string $departure_at,
        private string $arrival_agency,
        private string $arrival_at,
        private int $seats_available,
        private int $seats_total,
        private int $employee_id
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
        return new DateTime($this->departure_at)->format('d/m/Y');
    }

    public function getInputDepartureDate(): string {
        return new DateTime($this->departure_at)->format('Y-m-d');
    }

    public function getDepartureTime(): string {
        return new DateTime($this->departure_at)->format('H:i');
    }

    public function getArrivalAgency(): string {
        return $this->arrival_agency;
    }

    public function getArrivalDate(): string {
        return new DateTime($this->arrival_at)->format('d/m/Y');    
    }

    public function getInputArrivalDate(): string {
        return new DateTime($this->arrival_at)->format('Y-m-d');    
    }

    public function getArrivalTime(): string {
        return new DateTime($this->arrival_at)->format('H:i');
    }

    public function getSeatsAvailable(): int {
        return $this->seats_available;
    }

    public function getSeatsTotal(): int {
        return $this->seats_total;
    }

    public function getEmployeeId(): int {
        return $this->employee_id;
    }

}