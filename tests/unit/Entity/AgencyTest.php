<?php
namespace Tests\unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Agency;

class AgencyTest extends TestCase {

    private Agency $agency;

    protected function setUp(): void {
        $this->agency = new Agency(
            id: 1,
            city: 'Paris'
        );
    }
    
    public function testAgencyProperties() {
        $agency = new Agency(1, 'Paris');

        $this->assertEquals(1, $agency->getId());
        $this->assertEquals('Paris', $agency->getCity());
    }

    public function testToArray() {
        $this->assertIsArray($this->agency->toArray());

        $this->assertArrayHasKey('id', $this->agency->toArray());
        $this->assertArrayHasKey('city', $this->agency->toArray());
    }
}