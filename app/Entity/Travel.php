<?php
namespace App\Entity;

use DateTime;

class Travel {
    
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

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDepartureAgency(): string {
        return $this->departure_agency;
    }

    public function getDepartureAt(): DateTime {
        return $this->departure_at;
    }

    public function getArrivalAgency(): string {
        return $this->arrival_agency;
    }

    public function getArrivalAt(): DateTime {
        return $this->arrival_at;    
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