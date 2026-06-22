<?php
namespace Tests\unit\Entity;

use App\Entity\Employee;
use PHPUnit\Framework\TestCase;

class EmployeeTest extends TestCase {

    private Employee $employee;

    protected function setUp(): void {
        $this->employee = new Employee(
            id: 1,
            lastname: 'Doe',
            firstname: 'John',
            phone: '0612345678',
            email: 'john.doe@email.com',
            password: '*******',
            role: 'USER'
        );
    }

    public function testEmployeeProperties() {

        $this->assertEquals(1, $this->employee->getId());
        $this->assertEquals('Doe', $this->employee->getLastname());
        $this->assertEquals('John', $this->employee->getFirstname());
        $this->assertEquals('0612345678', $this->employee->getPhone());
        $this->assertEquals('john.doe@email.com', $this->employee->getEmail());
        $this->assertEquals('*******', $this->employee->getPassword());
        $this->assertEquals('USER', $this->employee->getRole());
    }


    public function testFullname() {

        $this->assertEquals('John Doe', $this->employee->getFullname());
    }

    public function testToArray() {

        $this->assertIsArray($this->employee->toArray());

        $this->assertArrayHasKey('id',$this->employee->toArray());
        $this->assertArrayHasKey('firstname',$this->employee->toArray());
        $this->assertArrayHasKey('lastname',$this->employee->toArray());
        $this->assertArrayHasKey('email',$this->employee->toArray());
        $this->assertArrayHasKey('phone',$this->employee->toArray());
        $this->assertArrayHasKey('password',$this->employee->toArray());
        $this->assertArrayHasKey('role',$this->employee->toArray());
    }
}