<?php
namespace App\Controllers;

use App\Models\AgenciesModel;
use PhpParser\Node\Expr\Cast\Object_;

class AgenciesController {
    private AgenciesModel $agenciesModel;

    public function __construct()
    {
        $this->agenciesModel = new AgenciesModel();
    }

    public function getAllAgencies(): array|null {
        return $this->agenciesModel->findAllAgencies();
    } 

    public function createNewAgency(array $data): void {
        $agencies = $this->agenciesModel->findAllAgencies();
        
        foreach($agencies as $agency) {
            if($agency->getCity() === $data['city']) {
                header('Location: /dashboard/#agencies');
                exit;
            }
        }
        $this->agenciesModel->createAgency($data);
    }

}