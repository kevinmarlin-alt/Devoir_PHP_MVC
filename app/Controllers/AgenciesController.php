<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Controllers;

use App\Models\AgenciesModel;
use App\Entity\Agency;

/**
 * Contrôleur des agences
 */
class AgenciesController {

    /**
     * @var AgenciesModel $agenciesModel
     */
    private AgenciesModel $agenciesModel;

    /**
     * Initialise le contrôleur
     */
    public function __construct()
    {
        $this->agenciesModel = new AgenciesModel();
    }

    /**
     * Retourne toutes les agences
     * 
     * @return Agency[]|null
     */
    public function getAllAgencies(): array|null {
        return $this->agenciesModel->findAllAgencies();
    } 

    /**
     * Crée une nouvelle agence 
     * 
     * En fonction du nom de la ville uniquement
     * 
     * @param array<string,mixed> $data
     * @return void
     */
    public function createNewAgency(array $data): void {
        $agencies = $this->agenciesModel->findAllAgencies();
        
        foreach($agencies as $agency) {
            if($agency->getCity() === $data['city']) {
                header('Location: /dashboard/#agencies');
                exit;
            }
        }
        $this->agenciesModel->createAgency($data['city']);
    }

    /**
     * Supprime une agence
     * 
     * @param int $id
     * @return bool
     */
    public function deleteAgency(int $id): bool {
        return $this->agenciesModel->deleteOne($id);
    }
}