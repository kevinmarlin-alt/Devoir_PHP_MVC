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
use App\Core\Controller;
use App\Entity\Travel;
use App\Models\TravelsModel;
use App\Models\AgenciesModel;

/**
 * Contrôleur des trajets
 */
class TravelsControllers extends Controller {
    /**
     * @var TravelsModel $travelsModel
     */
    private TravelsModel $travelsModel;

    /**
     * Initialise le contrôleur
     */
    public function __construct() {
        $this->travelsModel = new TravelsModel();
    }

    /**
     * Retourne un trajet en fonction de son identifiant
     * 
     * @return Travel|null
     */
    public function getTravelById(int $idTravel): Travel|null {
        return $this->travelsModel->findTravelById($idTravel);
    }

    /**
     * Affiche la page de création d'un trajet
     * 
     * @return void
     */
    public function createIndex(): void {
        $agencies = (new AgenciesModel)->findAllAgencies();
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $this->render(
            'Créer un trajet', 
            'Travels/create', 
            compact('agencies', 'employee')
        );
    }

    /**
     * Affiche la page de modification d'un trajet
     * 
     * @param int $id
     * @return void
     */
    public function updateIndex(int $id): void {
        $agencies = (new AgenciesModel)->findAllAgencies();
        $employee = (new EmployeeController)->getEmployeeById($_SESSION['user']['id']);
        $travel = $this->getTravelById($id);
 
        $this->render(
            'Mettre a jour un trajet',
            'Travels/update',
            compact('employee', 'travel', 'agencies')
        );
    }

    /**
     * Met à jour un trajet
     * 
     * @param int $id
     * @param mixed $data
     * @return void
     */
    public function updateTravel(int $id, mixed $data): void {
        $update = $this->travelsModel->updateTravel($id, $data);

        if($update) {
            Banner::add(
                type: 'success',
                message: 'Le trajet a bien été mis à jour.'
            );
        } else {
            Banner::add(
                type: 'danger',
                message: 'Le trajet n\'a pas été mis à jour.'
            );
        }    }

    /**
     * Crée un trajet et recharge la page d'acceuil
     * 
     * @return void
     */
    public function createNewTravel(): void {
        $add = $this->travelsModel->addTravel($_POST);

        if($add) {
            Banner::add(
                type: 'success',
                message: 'Le trajet a bien été enregistré.'
            );
        } else {
            Banner::add(
                type: 'danger',
                message: 'Le trajet n\'a pas été enregistré.'
            );
        }
        header('Location: /');
  
    }

    /**
     * Retourne tous les trajets 
     * 
     * @return Travel[]|null
     */
    public function getAllTravels(): array|null {
        return $this->travelsModel->findAllTravels();

    }

    /**
     * Retourne les trajets disponible
     * 
     * @return Travel[]|null
     */
    public function getAvailableTravels(): array|null {
        return $this->travelsModel->findAllTravelsAvailable();
    }

    /**
     * Supprime un trajet en fonction de son identifiant
     * 
     * @param int $id
     * @return void
     */
    public function deleteTravel(int $id): void {
        $del = $this->travelsModel->deleteOne($id);

        if($del) {
            Banner::add(
                type: 'success',
                message: 'Le trajet a bien été supprimé.'
            );
        } else {
            Banner::add(
                type: 'danger',
                message: 'Le trajet n\'a pas été supprimé.'
            );
        }
    }
}