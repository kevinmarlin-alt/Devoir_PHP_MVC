<?php
namespace Tests\unit\Models;

use App\Entity\Travel;
use App\Models\TravelsModel;
use DateInterval;
use DateTime;
use Override;
use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;

class TravelsModelTest extends TestCase {

    private array $travelToAdd;

    #[Override]
    protected function setUp(): void
    {
        $this->travelToAdd = [
            'departure_agency_id' => 1,
            'departure_date' => (new DateTime()->add(new DateInterval('P1D')))->format('Y-m-d'),
            'departure_time' => (new DateTime()->add(new DateInterval('P1D')))->format('H:i'),
            'arrival_agency_id' => 2,
            'arrival_date' => (new DateTime()->add(new DateInterval('P2D')))->format('Y-m-d'),
            'arrival_time' => (new DateTime()->add(new DateInterval('P2D')))->format('H:i'),
            'seats_total' => 4,
            'seats_available' => 4,
            'employee_id' => 1
        ];

    }

    public function testFindTravelByIdReturnTravel() {
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

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn([
                'id' => 1,
                'departure_agency' => 'Paris',
                'departure_at' => '2016-06-21 22:30:00',
                'arrival_agency' => 'Lille',
                'arrival_at' => '2016-06-22 22:30:00',
                'seats_available' => 2,
                'seats_total' => 4,
                'employee_id' => 1
            ]);

        $model = new TravelsModel($pdo);

        $travel = $model->findTravelById(1);
        $this->assertInstanceOf(Travel::class, $travel);
    }

    public function testFindTravelByIdReturnNull() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'id' => 1
            ]);

        $query->expects($this->once())
            ->method('fetch')
            ->willReturn(false);

        $model = new TravelsModel($pdo);

        $travel = $model->findTravelById(1);
        $this->assertNull($travel);
    }


    public function testFindAllTravelsAvailableReturnArrayOfTravel() {
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
                    'departure_agency' => 'Paris',
                    'departure_at' => (new DateTime()->add(new DateInterval('P1D')))->format('Y-m-d H:i:s'),
                    'arrival_agency' => 'Lille',
                    'arrival_at' => (new DateTime()->add(new DateInterval('P2D')))->format('Y-m-d H:i:s'),
                    'seats_available' => 4,
                    'seats_total' => 4,
                    'employee_id' => 1
                ],
                [
                    'id' => 2,
                    'departure_agency' => 'Nantes',
                    'departure_at' => (new DateTime()->sub(new DateInterval('P2D')))->format('Y-m-d H:i:s'),
                    'arrival_agency' => 'Rennes',
                    'arrival_at' => (new DateTime()->sub(new DateInterval('P1D')))->format('Y-m-d H:i:s'),
                    'seats_available' => 2,
                    'seats_total' => 4,
                    'employee_id' => 1
                ]
            ]);

        $model = new TravelsModel($pdo);

        $travels = $model->findAllTravelsAvailable();
        
        $this->assertIsArray($travels);
        $this->assertContainsOnlyInstancesOf(Travel::class, $travels);
    }

    public function testFindAllTravelsAvailableReturnEmptyArray() {
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
            ->willReturn([]);

        $model = new TravelsModel($pdo);

        $travels = $model->findAllTravelsAvailable();

        $this->assertIsArray($travels);
        $this->assertCount(0, $travels);
    }

    public function testAddTravel() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'departure_agency_id' => 1,
                'departure_at' => (new DateTime()->add(new DateInterval('P1D')))->format('Y-m-d H:i'). ":00",
                'arrival_agency_id' => 2,
                'arrival_at' => (new DateTime()->add(new DateInterval('P2D')))->format('Y-m-d H:i'). ":00",
                'seats_total' => 4,
                'seats_available' => 4,
                'employee_id' => 1,
            ])
            ->willReturn(true);

        $model = new TravelsModel($pdo);

        $travels = $model->addTravel($this->travelToAdd);

        $this->assertIsBool($travels);
    }

    public function testUpdateTravel() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'departure_agency_id' => 1,
                'departure_at' => (new DateTime()->add(new DateInterval('P1D')))->format('Y-m-d H:i'). ":00",
                'arrival_agency_id' => 2,
                'arrival_at' => (new DateTime()->add(new DateInterval('P2D')))->format('Y-m-d H:i'). ":00",
                'seats_total' => 4,
                'seats_available' => 4,
                'employee_id' => 1,
            ])
            ->willReturn(true);

        $model = new TravelsModel($pdo);

        $travels = $model->addTravel($this->travelToAdd);

        $this->assertIsBool($travels);
    }

    public function testDeleteOneTravelById() {
        $pdo = $this->createMock(PDO::class);
        $query = $this->createMock(PDOStatement::class);

        $pdo->expects($this->once())
            ->method('prepare')
            ->willReturn($query);

        $query->expects($this->once())
            ->method('execute')
            ->with([
                'id' => 1,
            ])
            ->willReturn(true);

        $model = new TravelsModel($pdo);

        $travels = $model->deleteOne(1);

        $this->assertIsBool($travels);
    }

    public function testFindAllTravelsReturnArrayOfTravel() {
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
                    'departure_agency' => 'Paris',
                    'departure_at' => (new DateTime()->add(new DateInterval('P1D')))->format('Y-m-d H:i:s'),
                    'arrival_agency' => 'Lille',
                    'arrival_at' => (new DateTime()->add(new DateInterval('P2D')))->format('Y-m-d H:i:s'),
                    'seats_available' => 4,
                    'seats_total' => 4,
                    'employee_id' => 1
                ],
                [
                    'id' => 2,
                    'departure_agency' => 'Nantes',
                    'departure_at' => (new DateTime()->sub(new DateInterval('P2D')))->format('Y-m-d H:i:s'),
                    'arrival_agency' => 'Rennes',
                    'arrival_at' => (new DateTime()->sub(new DateInterval('P1D')))->format('Y-m-d H:i:s'),
                    'seats_available' => 2,
                    'seats_total' => 4,
                    'employee_id' => 1
                ]
            ]);

        $model = new TravelsModel($pdo);

        $travels = $model->findAllTravels();
        
        $this->assertIsArray($travels);
        $this->assertContainsOnlyInstancesOf(Travel::class, $travels);
    }

    public function testFindAllTravelsReturnEmptyArray() {
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
            ->willReturn([]);

        $model = new TravelsModel($pdo);

        $travels = $model->findAllTravels();
        
        $this->assertIsArray($travels);
        $this->assertCount(0, $travels);
    }

}