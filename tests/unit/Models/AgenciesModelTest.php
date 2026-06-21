<?php
declare(strict_types=1);
namespace Tests\unit;

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
}