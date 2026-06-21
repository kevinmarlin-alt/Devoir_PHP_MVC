<?php
namespace Tests\unit\Models;

use App\Entity\Employee;
use App\Models\EmployeeModel;
use PHPUnit\Framework\TestCase;
use PDO;
use PDOStatement;

class EmployeeModelTest extends TestCase {

    public function testFindEmployeeByEmailReturnEmployee() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                ':email' => 'john.doe@email.com'
            ])
            ->willReturn(true);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn([
                'id' => 1,
                'lastname' => 'Doe',
                'firstname' => 'John',
                'phone' => '0600000000',
                'email' => 'john.doe@email.com',
                'passeword' => '######',
                'role' => 'USER'
            ]);

        $model = new EmployeeModel($pdo);

        $employee = $model->findEmployeeByEmail('john.doe@email.com');

        $this->assertInstanceOf(Employee::class, $employee);

    }

    public function testFindEmployeeByEmailReturnNull() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                ':email' => 'xxxxx.xxxxx@email.com'
            ])
            ->willReturn(false);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn([]);

        $model = new EmployeeModel($pdo);

        $employee = $model->findEmployeeByEmail('xxxxx.xxxxx@email.com');

        $this->assertNull($employee);

    }

    public function testFindEmployeeByIdReturnEmployee() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                ':id' => 1
            ])
            ->willReturn(true);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn([
                'id' => 1,
                'lastname' => 'Doe',
                'firstname' => 'John',
                'phone' => '0600000000',
                'email' => 'john.doe@email.com',
                'passeword' => '######',
                'role' => 'USER'
            ]);

        $model = new EmployeeModel($pdo);

        $employee = $model->findEmployeeById(1);
        $this->assertInstanceOf(Employee::class, $employee);
    }
    
    
    public function testFindEmployeeByIdReturnNull() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                ':id' => 1
            ])
            ->willReturn(false);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $model = new EmployeeModel($pdo);

        $employee = $model->findEmployeeById(1);
        $this->assertNull($employee);
    }

    public function testFindAllEmployeesReturnArrayOfEmployee() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->willReturn(true);

        $query->expects($this->once())
            ->method('fetchAll')
            ->willReturn([
                [
                    'id' => 1,
                    'lastname' => 'Doe',
                    'firstname' => 'John',
                    'phone' => '0600000000',
                    'email' => 'john.doe@email.com',
                    'passeword' => '######',
                    'role' => 'USER'
                ],
                [
                    'id' => 2,
                    'lastname' => 'Pierre',
                    'firstname' => 'Martin',
                    'phone' => '0600000001',
                    'email' => 'pierre.martin@email.com',
                    'passeword' => '######',
                    'role' => 'USER'
                ]
            ]);

        $model = new EmployeeModel($pdo);

        $employees = $model->findAllEmployees();
        $this->assertIsArray($employees);
        $this->assertContainsOnlyInstancesOf(Employee::class, $employees);
    }

        public function testAddPasswordAndReturnTrue() {
            $pdo = $this->createMock(PDO::class);
            $query = $this->createMock(PDOStatement::class);

            $pdo->expects($this->once())
                ->method('prepare')
                ->willReturn($query);

            $query->expects($this->once())
                ->method('execute')
                ->with($this->callback(function ($params) {
                    $this->assertArrayHasKey(':passwordHashed', $params);
                    $this->assertArrayHasKey(':id', $params);

                    $this->assertEquals(1, $params[':id']);

                    return password_verify(
                        'MotDePasseFort123!',
                        $params[':passwordHashed']
                    );
                }))
                ->willReturn(true);

            $model = new EmployeeModel($pdo);
            $employee = $model->addPassword(1, 'MotDePasseFort123!');

            $this->assertIsBool($employee);
        }
    }