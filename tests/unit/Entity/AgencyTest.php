<?php
namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Agency;

class AgencyTest extends TestCase {
    
    public function testAgencyProperties()
    {
        $agency = new Agency(1, 'Paris');

        $this->assertEquals(1, $agency->getId());
        $this->assertEquals('Paris', $agency->getCity());
    }
}