<?php
namespace App\Controllers;

use App\Core\Controller;

class HomepageController extends Controller {

    public function index() {
        $travels = (new TravelsControllers)->getAvailableTravels();
        $this->render(
            title:'Accueil',
            view: 'homepage',
            vars: compact('travels')
        );
    }

}