<?php
namespace Tests\unit\Entity;

use App\Entity\Travel;
use DateTime;
use PHPUnit\Framework\TestCase;

class TravelTest extends TestCase {
    private Travel $travel;

    protected function setUp(): void {
        $this->travel = new Travel(
            id: 1,
            departure_agency:'Paris',
            departure_at: '2026-06-21 14:30:00',
            arrival_agency:'Lille',
            arrival_at: '2026-06-21 18:00:00', 
            seats_available: 2,
            seats_total: 4,
            employee_id: 1
        );
    }

    public function testTravelProperties() {
        $this->assertEquals(1, $this->travel->getId());
        $this->assertEquals('Paris', $this->travel->getDepartureAgency());
        $this->assertEquals(new DateTime('2026-06-21 14:30:00'), $this->travel->getDepartureAt());
        $this->assertEquals('Lille', $this->travel->getArrivalAgency());
        $this->assertEquals(new DateTime('2026-06-21 18:00:00'), $this->travel->getArrivalAt());
        $this->assertEquals(2, $this->travel->getSeatsAvailable());
        $this->assertEquals(4, $this->travel->getSeatsTotal());
        $this->assertEquals(1, $this->travel->getEmployeeId());
    }

    public function testToArray() {
        $this->assertIsArray($this->travel->toArray());

        $this->assertArrayHasKey('id', $this->travel->toArray());
        $this->assertArrayHasKey('departure_agency', $this->travel->toArray());
        $this->assertArrayHasKey('departure_at', $this->travel->toArray());
        $this->assertArrayHasKey('arrival_agency', $this->travel->toArray());
        $this->assertArrayHasKey('arrival_at', $this->travel->toArray());
        $this->assertArrayHasKey('seats_available', $this->travel->toArray());
        $this->assertArrayHasKey('seats_total', $this->travel->toArray());
        $this->assertArrayHasKey('employee_id', $this->travel->toArray());
    }
}