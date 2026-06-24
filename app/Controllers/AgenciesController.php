<?php
/**
 * Devoir PHP MCV
 * Site intranet pour la gestion de covoiturage des trajets entre agences
 *
 * @author Kevin Marlin
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Banner;
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
     * @return Agency[]|array
     */
    public function getAllAgencies(): array {
        return $this->agenciesModel->findAllAgencies();
    } 

    /**
     * Retourne une agences en fonction de son idendifiant
     * 
     * @return Agency|null
     */
    public function getAgencyById(int $id): Agency|null {
        return $this->agenciesModel->findOne($id);
    } 

    /**
     * Crée une nouvelle agence 
     * 
     * En fonction du nom de la ville uniquement
     * 
     * @param array{
     *      city:string
     * } $data
     * @return void
     */
    public function createNewAgency(array $data): void {

        /** @var string $city */
        $city = $data['city'];

        /** @var bool $add */
        $add = $this->agenciesModel->createAgency($city);

        if($add){
            Banner::add(
                type: 'success',
                message: 'L\'agence a bien été ajoutée.'
            );
        } else {
            Banner::add(
                type: 'danger',
                message: 'L\'agence n\'a pas été ajouté.'
            );
        }
        

    }

    /**
     * Met à jour le nom d'une agence
     * 
     * @param int $id
     * @param array{
     *      city:string
     * } $data
     * @return void
     */
    public function updateAgency(int $id, mixed $data): void {
        /**
         * @var string $city
         */
        $city = $data['city'];
        if(!$this->isUnique($city)) {
            header('Location: /dashboard');
            exit;
        }
        /** @var bool $update */
        $update = $this->agenciesModel->updateAgency($id, $data);
        if($update){
            Banner::add(
                type: 'success',
                message: 'L\'agence a bien été mise à jour.'
            );
        } else {
            Banner::add(
                type: 'danger',
                message: 'L\'agence n\'a pas été mise à jour.'
            );
        }
    }

    /**
     * Supprime une agence
     * 
     * @param int $id
     * @return void
     */
    public function deleteAgency(int $id): void {
        /** @var bool $del */
        $del = $this->agenciesModel->deleteOne($id);

        if($del){
            Banner::add(
                type: 'success',
                message: 'L\'agence a bien été supprimée.'
            );
        } else {
            Banner::add(
                type: 'danger',
                message: 'L\'agence n\'a pas été supprimée.'
            );
        }
        
    }

    /**
     * Vérifie si le nom de la ville est unique
     * 
     * @param string $city
     * @return bool
     */
    private function isUnique(string $city): bool {
        $agencies = $this->agenciesModel->findAllAgencies();
        foreach($agencies as $agency) {
            if($agency->getCity() === $city) {
                return false;
            }
        }
        return true;
    }
}