<?php
namespace App\Controllers;

use App\Entity\Agency;
use App\Models\AgenciesModel;

class AgenciesController {
    private AgenciesModel $agenciesModel;

    public function __construct()
    {
        $this->agenciesModel = new AgenciesModel();
    }

    public function getAllAgencies(): array|null {
        return $this->agenciesModel->findAllAgencies();
    } 

}