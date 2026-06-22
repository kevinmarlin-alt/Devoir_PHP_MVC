<?php
declare(strict_types=1);
namespace Tests\unit\Entity;

use App\Entity\Agency;
use App\Models\AgenciesModel;
use PHPUnit\Framework\TestCase;
use PDO;
use PDOStatement;

class AgenciesModelTest extends TestCase {
    
    public function testFindAllAgenciesReturnArrayOfAgency() {

        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo
            ->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query
            ->expects($this->once())
            ->method('execute');
        
        $query->expects($this->once())
            ->method('fetchAll')
            ->willReturn([
                [
                    'id' => 1,
                    'city' => 'Paris'
                ],
                [
                    'id' => 2,
                    'city' => 'Lyon'
                ],
            ]);

        $model = new AgenciesModel($pdo);

        $agencies = $model->findAllAgencies();

        $this->assertIsArray($agencies);
        $this->assertContainsOnlyInstancesOf(Agency::class, $agencies);
    }
    
    public function testFindAllAgenciesReturnEmptyArray() {

        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo
            ->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query
            ->expects($this->once())
            ->method('execute');
        
        $query->expects($this->once())
            ->method('fetchAll')
            ->willReturn([]);

        $model = new AgenciesModel($pdo);

        $agencies = $model->findAllAgencies();

        $this->assertIsArray($agencies);
        $this->assertCount(0, $agencies);
    }

    public function testFindOneReturnAnAgency() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'id' => 2
            ])
            ->willReturn(true);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn([
                'id' => 1,
                'city' => 'Paris'
            ]);

        $model = new AgenciesModel($pdo);

        $agency = $model->findOne(2);

        $this->assertInstanceOf(Agency::class, $agency);
    }

    public function testFindOneReturnNull() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'id' => 2
            ])
            ->willReturn(true);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $model = new AgenciesModel($pdo);

        $agency = $model->findOne(2);

        $this->assertNull($agency);
    }

    public function testCreateAgencyRetuenBoolean() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'city' => 'Paris'
            ])
            ->willReturn(true);


        $model = new AgenciesModel($pdo);

        $agency = $model->createAgency('Paris');

        $this->assertIsBool($agency);
    }

    public function testUpdateAgencyRetuenBoolean() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'id' => 1,
                'city' => 'Paris'
            ])
            ->willReturn(true);


        $model = new AgenciesModel($pdo);

        $data = [
            'city' => 'Paris'
        ];
        $agency = $model->updateAgency(1, $data);

        $this->assertIsBool($agency);
    }

    public function testDeleteOneRetuenBoolean() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'id' => 1
            ])
            ->willReturn(true);


        $model = new AgenciesModel($pdo);

        $agency = $model->deleteOne(1);

        $this->assertIsBool($agency);
    }
}